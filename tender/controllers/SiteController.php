<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistrationForm;
use yii\helpers\ArrayHelper;
use app\models\Tender;
use pesapalCheckStatus;
use app\models\Pesapaltransaction;
use app\models\Biddercategory;
use app\models\Bidder;

require_once('OAuth.php');
require_once('checkStatus.php');

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact('tenders@qed-tendersure.com')) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionPay() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact('tenders@qed-tendersure.com')) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionCompletepay() {
        $pesapalMerchantReference = null;
        $pesapalTrackingId = null;
        $checkStatus = new pesapalCheckStatus();
        if (isset($_GET['pesapal_merchant_reference'])) {
            $pesapalMerchantReference = $_GET['pesapal_merchant_reference'];
        }

        if (isset($_GET['pesapal_transaction_tracking_id'])) {
            $pesapalTrackingId = $_GET['pesapal_transaction_tracking_id'];
        }

        if (isset($pesapalMerchantReference) && isset($pesapalTrackingId)) {
            $responseArray = $checkStatus->getTransactionDetails($pesapalMerchantReference, $pesapalTrackingId);
            $transaction = Pesapaltransaction::findBySql("SELECT * from pesapaltransactions where referenceNo = '$pesapalMerchantReference'")->one();
            $transaction->paymentMethod = $responseArray['payment_method'];
            $transaction->trackingId = $responseArray['pesapal_transaction_tracking_id'];
            $transaction->status = $responseArray['status'];

            $transaction->save(false);

            $value = array("COMPLETED" => 1, "PENDING" => 2, "INVALID" => 0, "FAILED" => 0);
            $status = $value[$responseArray['status']];

            Biddercategory::updateAll(['paid' => $status], "pesapalreferenceno = '$pesapalMerchantReference'");

            //$bidder = Bidder::find($transaction->bidderuuid)->one();
            
            $bidderuuid = $transaction->bidderuuid;

            $bidder = Bidder::findBySql("SELECT * from bidder where uuid= '$bidderuuid'")->one();
            
            $body = "";
            switch ($responseArray['status']) {
                case 'COMPLETED':
                    $body = "Your payment of Ksh. $transaction->amount on pesapal has been received and verified";
                    $this->sendPaymentEmail($bidder->email, $body);
                    break;

                case 'FAILED':
                    $body = "Your payment of Ksh. $transaction->amount on pesapal has failed";
                    $this->sendPaymentEmail($bidder->email, $body);
                    break;
            }
        }

        return $this->render('completepay');
    }

    public function actionPesapalipn() {

        $pesapalTrackingId = null;
        $pesapalNotification = null;
        $pesapalMerchantReference = null;
        $checkStatus = new pesapalCheckStatus();
//        $database = new pesapalDatabase();

        if (isset($_GET['pesapal_merchant_reference'])) {
            $pesapalMerchantReference = $_GET['pesapal_merchant_reference'];
        }

        if (isset($_GET['pesapal_transaction_tracking_id'])) {
            $pesapalTrackingId = $_GET['pesapal_transaction_tracking_id'];
        }

        if (isset($_GET['pesapal_notification_type'])) {
            $pesapalNotification = $_GET['pesapal_notification_type'];
        }

        if (isset($pesapalMerchantReference) && isset($pesapalTrackingId) && isset($pesapalNotification)) {
            $transactionDetails = $checkStatus->getTransactionDetails($pesapalMerchantReference, $pesapalTrackingId);

            $value = array("COMPLETED" => 1, "PENDING" => 2, "INVALID" => 0, "FAILED" => 0);
            $status = $value[$transactionDetails['status']];

            $transaction = Pesapaltransaction::findBySql("SELECT * from pesapaltransactions where referenceNo = '$pesapalMerchantReference'")->one();
            $transaction->status = $transactionDetails['status'];

            Biddercategory::updateAll(['paid' => $status], "pesapalreferenceno = '$pesapalMerchantReference'");
            
            $bidderuuid = $transaction->bidderuuid;

            $bidder = Bidder::findBySql("SELECT * from bidder where uuid= '$bidderuuid'")->one();//find($transaction->bidderuuid);
            $body = "";
            switch ($transactionDetails['status']) {
                case 'COMPLETED':
                    $body = "Your payment of Ksh. $transaction->amount on pesapal has been received and verified";
                    $this->sendPaymentEmail($bidder->email, $body);
                    break;

                case 'FAILED':
                    $body = "Your payment of Ksh. $transaction->amount on pesapal has failed";
                    $this->sendPaymentEmail($bidder->email, $body);
                    break;
            }
        }

        $resp = "pesapal_notification_type=$pesapalNotification" .
                "&pesapal_transaction_tracking_id=$pesapalTrackingId" .
                "&pesapal_merchant_reference=$pesapalMerchantReference";

        ob_start();
        echo $resp;
        ob_flush();
        exit;
    }

    private function sendPaymentEmail($to, $body) {
        $subject = 'Tendersure online payment';
//        $body = "Your payment of Ksh. $amount on pesapal has been received and verified";

        $mailer = Yii::$app->mailer->compose()
                ->setTo($to)
                ->setFrom([Yii::$app->params['tendersEmail'] => 'Tendersure'])
                ->setSubject($subject)
                ->setTextBody($body);
        $mailer->send();
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionIndex($towner) {
        $model = new RegistrationForm();
        $list = [];
        $command = (new \yii\db\Query())
                ->select('tenderuuid, uuid, categoryname')
                ->from('category');

        $cmd = Yii::$app->db->createCommand("select uuid,logo from tenderowner where slug='$towner' limit 1");
        $rset1 = $cmd->queryAll();
        foreach ($rset1 as $row) {
            $to = $row['uuid'];
            $logo = $row['logo'];
        }

        $catList = ArrayHelper::map(Tender::find()
                                ->where("closedate>=date(now()) and tenderowneruuid=$to")
                                ->orderBy('tendername')
                                ->asArray()
                                ->all(), 'uuid', 'tendername');

        $rset = $command->all();
        $count = 0;
        foreach ($rset as $row) {
            $data[$row['uuid']] = $row['categoryname'];
            $count += 1;
        }


        $model->uuid = strval(intval(microtime(true)));

        if ($model->load(Yii::$app->request->post())) {
            $transaction = null;
            $list = $model->tendercategory;
            $file = \yii\web\UploadedFile::getInstance($model, 'file');
            $model->file = $file;
            if ($model->paymentapplicable === '1') {

                if ($model->amount !== $model->amthid) {
                    $model->addError('amount', 'Amount entered must be equal to total cost of selected categories');
                }

                if ($model->amount === null || $model->amount === 0) {
                    $model->addError('amount', 'Amount paid is required');
                }

                if ($file !== null) {
                    $filename = 'PaymentReceipt_' . md5(microtime()) . '.' . $file->extension;

                    $model->bankslip = $filename;
                } else {
                    $model->addError('file', 'Please upload evidence of payment');
                }
            } elseif ($model->paymentapplicable === '2') {
                $ref = str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 10);
                $ref1 = substr(str_shuffle($ref), 0, 20);

                $transaction = new Pesapaltransaction();
                $transaction->amount = $model->amthid;
                $transaction->bidderuuid = $model->uuid;
                $transaction->currency = 'KES';
                $transaction->referenceNo = $ref1;
            }

            if ($file !== null) {
                $file->saveAs(Yii::$app->params['uploadFolder'] . 'payment/' . $filename, false);
            }

            if (!$model->hasErrors()) {
                if ($model->save($transaction)) {
                    if ($model->paymentapplicable !== '2') {
                        Yii::$app->session->setFlash('formSubmitted', '<div class="alert alert-success">Your details have been submitted.</div>');
                        return $this->redirect(['towner' => $towner]);
                    } else {

//                        $transaction->save(false);

                        $amt = str_replace(',', '', $model->amthid); // remove thousands seperator if included
                        $amount = number_format($amt, 2);

                        return $this->render('pay', ['model' => $model, 'ref' => $ref1, 'amount' => $amount]);
                    }
                }
            }
        }

        $cmd1 = (new \yii\db\Query())
                ->select('categorycost')
                ->from('tender')
                ->where("uuid='$model->tenderowner'");

        $rst = $cmd1->all();
        $cost = 0;
        foreach ($rst as $row) {
            $cost = $row['categorycost'];
        }

        return $this->render('register', [
                    'model' => $model,
                    'clients' => $this->getClientList(),
                    'data' => $data,
                    'catList' => $catList,
                    'logo' => $logo,
                    'tc' => self::getSubCatList($model->tenderowner),
                    'list' => $list,
                    'cost' => $cost,
        ]);
    }

    public function actionCategory() {
        $out = [];
        if (isset($_POST['tender'])) {

            $parents = $_POST['tender'];
            if ($parents !== null) {

                $out = self::getSubCatList($parents);

                $command = (new \yii\db\Query())
                        ->select('categorycost')
                        ->from('tender')
                        ->where("uuid='$parents'");

                $rset = $command->all();
                $cost = 0;
                foreach ($rset as $row) {
                    $cost = $row['categorycost'];
                }
            }
        }

        return $this->renderPartial('_tendercategory', ['out' => $out, 'list' => [], 'cost' => $cost]);
    }

    public function actionPayment() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents !== null) {
                $cat_id = $parents[0];
                $out = self::getCatPayList($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function getSubCatList($cat_id) {

        $command = (new \yii\db\Query())
                ->select('uuid, categoryname')
                ->from('category')
                ->where("tenderuuid='$cat_id'");

        $rset = $command->all();
        $out = [];

        foreach ($rset as $row) {
            $out[$row['uuid']] = $row['categoryname'];
        }

        return $out;
    }

    public function getCatPayList($cat_id) {
        $command = (new \yii\db\Query())
                ->select('uuid, payment')
                ->from('category')
                ->where(['in', 'tenderuuid', $cat_id]);
        $rset = $command->all();
        $out = [];
        $count = 0;

        foreach ($rset as $row) {

            $out[$count] = ['id' => $row['uuid'], 'name' => $row['payment']];
            $count += 1;
        }
        return $out;
    }

    public function getClientList() {
        $command = Yii::$app->db->createCommand("select clientname from tenderowner order by rank asc, dateranked desc limit 12");
        $rset = $command->queryAll();
        $out = [];
        $count = 0;

        foreach ($rset as $row) {

            $out[$count] = $row['clientname'];
            $count += 1;
        }
        return $out;
    }

}