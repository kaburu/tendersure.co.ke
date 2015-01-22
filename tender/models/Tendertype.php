<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tendertype".
 *
 * @property integer $tendertypeid
 * @property string $tendertype
 *
 * @property Tender[] $tenders
 */
class Tendertype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tendertype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tendertype'], 'required'],
            [['tendertype'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tendertypeid' => 'Tendertypeid',
            'tendertype' => 'Tendertype',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenders()
    {
        return $this->hasMany(Tender::className(), ['tendertypeid' => 'tendertypeid']);
    }
}
