<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Description of RegistrationForm
 *
 * @author murimi
 */
class RegistrationForm extends Model {

    public $tenderowner;
    public $tendercategory;
    public $tenderpayment;
    public $companyname;
    public $contactperson;
    public $email;
    public $phone;
    public $comment;
    public $amount = 0;
    public $receipt;
    public $file;
    public $bankslip;
    public $paymentapplicable;
    public $uuid;
    public $amthid;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['companyname', 'tendercategory', 'tenderowner', 'contactperson', 'email', 'phone', 'amthid'], 'required'],
            [['amount'], 'integer'],
            [['amthid'], 'integer'],
            [['phone'], 'integer'],
            [['email'], 'email'],
            [['file'], 'file', 'extensions' => 'gif,bmp, pdf, doc, docx, png, jpg, jpeg'],
            [['paymentapplicable'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'uuid' => 'Uuid',
            'bankslip' => 'Bankslip',
            'companyname' => 'Company Name',
            'contactperson' => 'Contact person',
            'email' => 'Email',
            'phone' => 'Phone number',
            'comment' => 'Comments',
            'file' => 'Upload Proof of Payment',
            'tendercategory' => 'Tender category',
            'tenderowner' => 'Tender',
            'amount' => 'Amount paid',
            'receipt' => 'Receipt Number (where applicable)',
            'paymentapplicable' => 'Select mode of payment '
        ];
    }

    public function save(Pesapaltransaction $ptrx) {
        $success = false;
        if ($this->validate()) {


            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
                $sql1 = "INSERT INTO bidder(uuid,name,company,
            mobile,email)VALUES(:uuid,:name,:company,
            :mobile,:email);";


                $command1 = $connection->createCommand($sql1);
                $command1->bindParam(':uuid', $this->uuid);
                $command1->bindParam(':name', $this->contactperson);
                $command1->bindParam(':company', $this->companyname);
                $command1->bindParam(':mobile', $this->phone);
                $command1->bindParam(':email', $this->email);

                $command1->execute();






                $uuidp = str_replace('0.', '', str_replace(' ', '', strval(microtime())));

                if ($this->paymentapplicable === '1') {
                    $sql3 = "INSERT INTO payment(uuid,biddercategoryuuid,receipt,
            amount,filename)VALUES(:uuid,:biddercategoryuuid,
            '$this->receipt',:amount,:filename);";

                    $command3 = $connection->createCommand($sql3);
                    $command3->bindParam(':uuid', $uuidp);
                    $command3->bindParam(':biddercategoryuuid', json_encode($this->tendercategory));
                    $command3->bindParam(':amount', $this->amount);
                    $command3->bindParam(':filename', $this->bankslip);

                    $command3->execute();
                } elseif ($this->paymentapplicable === '2') {
                    $ptrx->save(false);
                }






                $sql2 = "INSERT INTO biddercategory(uuid,categoryuuid,"
                        . "bidderuuid,paid,,comment)VALUES(:uuid,:category,"
                        . ":bidderuuid,:paid,'$this->comment');";

                $sql2_0 = "INSERT INTO biddercategory(uuid,categoryuuid,"
                        . "bidderuuid,paid,pesapalreferenceno,comment)VALUES(:uuid,:category,"
                        . ":bidderuuid,:paid,'$ptrx->referenceNo','$this->comment');";



                $sql2_1 = "INSERT INTO biddercategory(uuid,categoryuuid,"
                        . "bidderuuid,paid,bankpaymentuuid,comment)VALUES(:uuid,:category,"
                        . ":bidderuuid,:paid,'$uuidp','$this->comment');";

                if ($this->paymentapplicable === '1') {
                    $p = 2;
                } elseif ($this->paymentapplicable === '2' && $ptrx->status === 'COMPLETED') {
                    $p = 1;
                } elseif (!$this->paymentapplicable) {
                    $p = 3;
                } else {
                    $p = 0;
                }
                foreach ($this->tendercategory as $category):
                    $uuid2 = str_replace('0.', '', str_replace(' ', '', strval(microtime())));
                    if ($this->paymentapplicable === '1') {
                        $command2 = $connection->createCommand($sql2_1);
                    } elseif ($this->paymentapplicable === '2') {
                        $command2 = $connection->createCommand($sql2_0);
                    } else {
                        $command2 = $connection->createCommand($sql2);
                    }
                    $command2->bindParam(':uuid', $uuid2);
                    $command2->bindParam(':bidderuuid', $this->uuid);
                    $command2->bindParam(':paid', $p, \PDO::PARAM_INT);
                    $command2->bindParam(':category', $category);


                    $command2->execute();


                endforeach;
                $transaction->commit();
                $this->sendEmail();
                return true;
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $success;
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function sendEmail() {
        date_default_timezone_set('Africa/Nairobi');

        $emails = [Yii::$app->params['tendersEmail'], Yii::$app->params['infoEmail']];
        $subject = 'Tendersure Registration for ' . $this->companyname;
        $body = "The following bidder has registered on tendersure.\n"
                . "Information entered is  a follows:\n"
                . "\tCompany Name\t$this->companyname\n"
                . "\tContact Person:\t$this->contactperson\n"
                . "\tPhone Number:\t$this->phone\n"
                . "\tEmail:\t\t$this->email\n";
        $body = $body . "\tTender Category:\t";
        foreach ($this->tendercategory as $tcategory):
            $category = Category::findOne($tcategory)->categoryname;
            $body = $body . $category . "\n\t";
        endforeach;
        $body = $body . "\n";
        if ($this->receipt !== null) {
            $body = $body . "\tReceipt:\t\t$this->receipt";
        }
        if ($this->comment != null && $this->comment !== '') {
            $body = $body . "\tComment:\t\t$this->comment";
        }
        $body = $body . "This message was generated on " . date('Y/m/d h:i a');
        $mailer = Yii::$app->mailer->compose()
                ->setTo($emails)
                ->setFrom([Yii::$app->params['tendersEmail'] => 'Tendersure'])
                ->setSubject($subject)
                ->setTextBody($body);
        if ($this->file !== null) {
            $mailer->attach(Yii::$app->params['uploadFolder'] . 'payment/' . $this->bankslip);
        }
        $mailer->send();

        $cbody = "Dear $this->contactperson\n\n"
                . "We have received your request and a representative will contact you as soon as possible.\n"
                . "The information entered is as follows:\n"
                . "\tCompany Name:\t$this->companyname\n"
                . "\tContact Person:\t$this->contactperson\n"
                . "\tPhone Number:\t$this->phone\n"
                . "\tEmail:\t\t$this->email\n";
        $body = $body . "\tTender Category:\t";
        foreach ($this->tendercategory as $tcategory):
            $category = Category::findOne($tcategory)->categoryname;
            $cbody = $cbody . $category . "\n\t";
        endforeach;
        $cbody = $cbody . "\n";
//                . "\tTender Category:\t$category\n";
        if ($this->comment != null && $this->comment !== '') {
            $cbody = $cbody . "\tComment:\t\t$this->comment";
        }
        $cbody = $cbody . "\n\nThe Tendersure Team\n\n"
                . "You were sent this email because you requested registration on Tendersure\n\n"
                . "This message was generated on " . date('Y/m/d h:i a') . "\n";

        $subject = 'Tendersure Registration Confirmation';
        Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom([Yii::$app->params['tendersEmail'] => 'Tendersure'])
                ->setReplyTo(Yii::$app->params['tendersEmail'])
                ->setSubject($subject)
                ->setTextBody($cbody)
//                ->setHtmlBody($htmlbody)
                ->send();

        return true;
    }

}
