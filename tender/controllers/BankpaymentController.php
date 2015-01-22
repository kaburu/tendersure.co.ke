<?php

namespace app\controllers;

use Yii;
use app\models\Bankpayment;
use app\models\BankpaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BankpaymentController implements the CRUD actions for Bankpayment model.
 */
class BankpaymentController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Bankpayment models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BankpaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bankpayment model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bankpayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $category = str_getcsv(filter_input(INPUT_GET, 'category'));
//        $category = str_getcsv($_GET['category']);
        $count = 0;
        $cat = array();
        foreach ($category as $catuuid):
            $cat[] = \app\models\Biddercategory::findOne($catuuid);
            $count += 1;
        endforeach;

        $payment = 2000 * $count;

        $model = new Bankpayment();
        $model->bidderuuid = Yii::$app->user->getId();


//        var_dump(Yii::$app->request->get('category'));

        if ($model->load(Yii::$app->request->post())) {

            $file = \yii\web\UploadedFile::getInstance($model, 'bankslip');
            if ($file != null) {

                $filename = 'Bankslip_' . md5(microtime()) . '.' . $file->extension;

                $model->filename = $filename;
            }

            if ($model->validate() && $model->amount < $payment) {
                $model->addError('amount', 'The amount must be at least Ksh. ' . $payment);
            } else {
                $model->uuid = strval(intval(microtime(true)));
                if ($model->save()) {
                    $file->saveAs('../upload/bankslip/' . $filename);

                    foreach ($cat as $bcat):
                        $command = Yii::$app->db->createCommand("update biddercategory set bankpaymentuuid = '$model->uuid', paid = 2 where uuid = '" . $bcat->uuid . "'");
                        $command->execute();
//                        $bcat->bankpaymentuuid = $model->uuid;
//                        $bcat->isNewRecord = false;
//                        $bcat->save();
                    endforeach;

                    return $this->redirect(['view', 'id' => $model->uuid]);
                }
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'category' => $cat,
                    'payment' => $payment,
        ]);
    }

    /**
     * Updates an existing Bankpayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uuid]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Bankpayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bankpayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Bankpayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Bankpayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
