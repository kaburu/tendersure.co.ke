<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidder".
 *
 * @property string $uuid
 * @property string $name
 * @property string $address
 * @property string $company
 * @property string $username
 * @property string $password
 * @property string $mobile
 * @property string $email
 *
 * @property Bankpayment[] $bankpayments
 * @property Account $uu
 * @property Biddercategory[] $biddercategories
 * @property Pesapalpayment[] $pesapalpayments
 */
class Bidder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bidder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'company', 'mobile', 'email'], 'required'],
            [['address', 'mobile'], 'string'],
            [['uuid', 'username'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 30],
            [['company', 'password'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uuid' => 'Uuid',
            'name' => 'Name',
            'address' => 'Address',
            'company' => 'Company',
            'username' => 'Username',
            'password' => 'Password',
            'mobile' => 'Mobile',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankpayments()
    {
        return $this->hasMany(Bankpayment::className(), ['bidderuuid' => 'uuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUu()
    {
        return $this->hasOne(Account::className(), ['uuid' => 'uuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiddercategories()
    {
        return $this->hasMany(Biddercategory::className(), ['bidderuuid' => 'uuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesapalpayments()
    {
        return $this->hasMany(Pesapalpayment::className(), ['bidderuuid' => 'uuid']);
    }
}
