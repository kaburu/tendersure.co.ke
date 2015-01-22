<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "biddercategory".
 *
 * @property string $uuid
 * @property string $categoryuuid
 * @property string $bidderuuid
 * @property string $creationtime
 * @property integer $paid
 * @property string $pesapalreferenceno
 * @property string $bankpaymentuuid
 *
 * @property Bankpayment $bankpaymentuu
 * @property Bidder $bidderuu
 * @property Category $categoryuu
 * @property Pesapalpayment $pesapalpaymentuu
 * @property Payment[] $payments 
 */
class Biddercategory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'biddercategory';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['categoryuuid', 'bidderuuid'], 'required'],
            [['creationtime'], 'safe'],
            [['paid'], 'integer'],
            [['uuid', 'categoryuuid', 'bidderuuid', 'pesapalreferenceno', 'bankpaymentuuid'], 'string', 'max' => 20],
            [['categoryuuid', 'bidderuuid'], 'unique', 'targetAttribute' => ['categoryuuid', 'bidderuuid'], 'message' => 'You have already selected the category.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'uuid' => 'Uuid',
            'categoryuuid' => 'Categoryuuid',
            'bidderuuid' => 'Bidderuuid',
            'creationtime' => 'Creationtime',
            'paid' => 'Paid',
            'pesapalreferenceno' => 'Pesapalreferenceno',
            'bankpaymentuuid' => 'Bankpaymentuuid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankpaymentuu() {
        return $this->hasOne(Bankpayment::className(), ['uuid' => 'bankpaymentuuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidderuu() {
        return $this->hasOne(Bidder::className(), ['uuid' => 'bidderuuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryuu() {
        return $this->hasOne(Category::className(), ['uuid' => 'categoryuuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesapalpaymentuu() {
        return $this->hasOne(Pesapalpayment::className(), ['uuid' => 'pesapalpaymentuuid']);
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getPayments() {
        return $this->hasMany(Payment::className(), ['biddercategoryuuid' => 'uuid']);
    }

}
