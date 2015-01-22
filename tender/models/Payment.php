<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property string $uuid
 * @property string $biddercategoryuuid
 * @property string $receipt
 * @property integer $amount
 * @property string $filename
 * @property string $datepaid
 *
 * @property Biddercategory $biddercategoryuu
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid', 'biddercategoryuuid', 'receipt', 'amount', 'filename'], 'required'],
            [['amount'], 'integer'],
            [['datepaid'], 'safe'],
            [['uuid', 'biddercategoryuuid'], 'string', 'max' => 20],
            [['receipt'], 'string', 'max' => 30],
            [['filename'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uuid' => 'Uuid',
            'biddercategoryuuid' => 'Biddercategoryuuid',
            'receipt' => 'Receipt',
            'amount' => 'Amount',
            'filename' => 'Filename',
            'datepaid' => 'Datepaid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiddercategoryuu()
    {
        return $this->hasOne(Biddercategory::className(), ['uuid' => 'biddercategoryuuid']);
    }
}
