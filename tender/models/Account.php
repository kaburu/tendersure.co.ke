<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property string $uuid
 * @property string $username
 * @property string $password
 * @property integer $roleid
 * @property string $email
 *
 * @property Role $role
 * @property Bidder $bidder
 */
class Account extends \yii\db\ActiveRecord {

    public $passwd;
    public $confirmpasswd;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'email', 'passwd', 'confirmpasswd'], 'required'],
            [['passwd', 'confirmpasswd'], 'required', 'on' => 'insert'],
            [['passwd', 'confirmpasswd'], 'compare','compareAttribute'=>'passwd'],
            [['roleid'], 'integer'],
            [['uuid', 'username'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'uuid' => 'Uuid',
            'username' => 'Username',
            'password' => 'Password',
            'roleid' => 'Roleid',
            'email' => 'Email',
            'passwd' => 'Password',
            'confirmpasswd' => 'Confirm Password'
        ];
    }
    
    public function beforeSave($insert) {
        $this->password = $this->passwd;
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole() {
        return $this->hasOne(Role::className(), ['roleid' => 'roleid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidder() {
        return $this->hasOne(Bidder::className(), ['uuid' => 'uuid']);
    }

}
