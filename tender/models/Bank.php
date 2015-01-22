<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property string $uuid
 * @property string $bankname
 *
 * @property Bankpayment[] $bankpayments
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid', 'bankname'], 'required'],
            [['uuid'], 'string', 'max' => 20],
            [['bankname'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uuid' => 'Uuid',
            'bankname' => 'Bankname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankpayments()
    {
        return $this->hasMany(Bankpayment::className(), ['bankuuid' => 'uuid']);
    }
}
