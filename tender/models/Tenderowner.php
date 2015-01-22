<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tenderowner".
 *
 * @property string $uuid
 * @property string $clientname
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $logo
 *
 * @property Tender[] $tenders
 */
class Tenderowner extends \yii\db\ActiveRecord
{
    public $logofile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tenderowner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientname', 'address', 'phone', 'email', 'logo'], 'required'],
            [['address', 'phone'], 'string'],
            [['uuid'], 'string', 'max' => 20],
            [['clientname'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['logo'], 'string', 'max' => 255],
            [['logofile'], 'file', 'extensions' => 'jpg, png, bmp, jpeg, gif'],
            [['logofile'], 'file', 'maxFiles' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uuid' => 'Uuid',
            'clientname' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'logo' => 'Logo',
            'logofile' => 'Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenders()
    {
        return $this->hasMany(Tender::className(), ['tenderowneruuid' => 'uuid']);
    }
}
