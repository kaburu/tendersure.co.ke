<?php

namespace app\models;

/**
 * This is the model class for table "pesapaltransactions".
 *
 * @property integer $id
 * @property string $currency
 * @property double $amount
 * @property string $status
 * @property string $referenceNo
 * @property string $trackingId
 * @property string $paymentMethod
 * @property string $bidderuuid
 *
 * @property Bidder $bidderuu
 */
class Pesapaltransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pesapaltransactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency', 'amount', 'referenceNo', 'bidderuuid'], 'required'],
            [['amount'], 'number'],
            [['currency'], 'string', 'max' => 3],
            [['status'], 'string', 'max' => 10],
            [['referenceNo', 'paymentMethod', 'bidderuuid'], 'string', 'max' => 20],
            [['trackingId'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency' => 'Currency',
            'amount' => 'Amount',
            'status' => 'Status',
            'referenceNo' => 'Reference No',
            'trackingId' => 'Tracking ID',
            'paymentMethod' => 'Payment Method',
            'bidderuuid' => 'Bidderuuid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidderuu()
    {
        return $this->hasOne(Bidder::className(), ['uuid' => 'bidderuuid']);
    }
}
