<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bankpayment".
 *
 * @property string $uuid
 * @property string $bankuuid
 * @property string $receiptno
 * @property integer $amount
 * @property string $datepaid
 * @property string $creationdate
 * @property string $filename
 * @property string $bidderuuid
 *
 * @property Bidder $bidderuu
 * @property Bank $bankuu
 * @property Biddercategory[] $biddercategories
 */
class Bankpayment extends \yii\db\ActiveRecord
{
    
    public $bankslip;
    public $payment;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bankpayment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bankuuid', 'receiptno', 'amount', 'datepaid', 'bidderuuid', 'filename'], 'required'],
            [['amount'], 'integer'],
//            [['amount'], 'integer', 'max' => $this->payment],
            [['bankslip'], 'file', 'extensions' => 'jpg, png, bmp, jpeg, gif'],
            [['bankslip'], 'file', 'maxFiles' => 1],
//            [['bankslip'], 'file', 'skipOnEmpty' => false],
            [['datepaid', 'creationdate'], 'safe'],
            [['uuid', 'bankuuid', 'bidderuuid'], 'string', 'max' => 20],
            [['receiptno'], 'string', 'max' => 40],
            [['filename'], 'string', 'max' => 255],
            [['filename'], 'unique'],
            [['bankuuid', 'receiptno'], 'unique', 'targetAttribute' => ['bankuuid', 'receiptno'], 'message' => 'The bank slip with the specified receipt number has already been uploaded.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uuid' => 'Uuid',
            'bankuuid' => 'Bank',
            'receiptno' => 'Receipt number/ Deposit slip number',
            'amount' => 'Amount',
            'datepaid' => 'Datepaid',
            'creationdate' => 'Creationdate',
            'filename' => 'Bankslip',
            'bidderuuid' => 'Bidderuuid',
            'bankslip' => 'Bankslip'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidderuu()
    {
        return $this->hasOne(Bidder::className(), ['uuid' => 'bidderuuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankuu()
    {
        return $this->hasOne(Bank::className(), ['uuid' => 'bankuuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiddercategories()
    {
        return $this->hasMany(Biddercategory::className(), ['bankpaymentuuid' => 'uuid']);
    }
}
