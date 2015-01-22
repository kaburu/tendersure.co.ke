<?php

namespace app\models;

/**
 * This is the model class for table "category".
 *
 * @property string $uuid
 * @property integer $categorynumber
 * @property string $categoryname
 * @property string $tenderuuid
 *
 * @property Biddercategory[] $biddercategories
 * @property Tender $tenderuu
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categorynumber', 'categoryname', 'tenderuuid'], 'required'],
            [['categorynumber'], 'integer'],            
            [['categorynumber'], 'integer', 'min' => 1],
            [['uuid', 'tenderuuid'], 'string', 'max' => 20],
            [['tenderuuid', 'categorynumber'], 'unique', 'targetAttribute' => ['tenderuuid', 'categorynumber'], 'message' => 'The category number for this tender already exists.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uuid' => 'Uuid',
            'categorynumber' => 'Category number',
            'categoryname' => 'Category name',
            'tenderuuid' => 'Tenderuuid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiddercategories()
    {
        return $this->hasMany(Biddercategory::className(), ['categoryuuid' => 'uuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenderuu()
    {
        return $this->hasOne(Tender::className(), ['uuid' => 'tenderuuid']);
    }
}
