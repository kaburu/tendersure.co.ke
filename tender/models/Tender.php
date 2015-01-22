<?php

namespace app\models;

/**
 * This is the model class for table "tender".
 *
 * @property string $uuid
 * @property string $tenderowneruuid
 * @property string $contact
 * @property string $tendername
 * @property string $opendate
 * @property string $opentime
 * @property string $closedate
 * @property string $closetime
 * @property string $description
 * @property integer $tendertypeid
 *
 * @property Category[] $categories
 * @property Tendertype $tendertype
 * @property Tenderowner $tenderowneruu
 * @property UploadedFile[] $uploadedFiles 
 */
class Tender extends \yii\db\ActiveRecord {

    public $tenderfile;
    public $fileid;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tender';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['tenderowneruuid', 'tendername', 'opendate', 'opentime', 'closedate', 'closetime', 'description'], 'required'],
            [['contact', 'tendername', 'description'], 'string'],
            [['opendate', 'opentime', 'closedate', 'closetime'], 'safe'],
            [['tendertypeid'], 'integer'],
            [['uuid', 'tenderowneruuid'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'uuid' => 'Uuid',
            'tenderowneruuid' => 'Tender owner',
            'contact' => 'Contact',
            'tendername' => 'Tendername',
            'opendate' => 'Opendate',
            'opentime' => 'Opentime',
            'closedate' => 'Closedate',
            'closetime' => 'Closetime',
            'description' => 'Description',
            'tendertypeid' => 'Tendertypeid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories() {
        return $this->hasMany(Category::className(), ['tenderuuid' => 'uuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTendertype() {
        return $this->hasOne(Tendertype::className(), ['tendertypeid' => 'tendertypeid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenderowneruu() {
        return $this->hasOne(Tenderowner::className(), ['uuid' => 'tenderowneruuid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploadedFiles() {
        return $this->hasMany(\mdm\upload\FileModel::className(), ['tenderuuid' => 'uuid']);
    }

    public function behaviors() {
        return [
            [
                'class' => 'mdm\upload\UploadBehavior',
                'attribute' => 'tenderfile', // required, use to receive input file
                'savedAttribute' => 'fileid', // optional, use to link model with saved file.
                'uploadPath' => '@web/../upload', // saved directory. default to '@runtime/upload'
                'autoSave' => true, // when true then uploaded file will be save before ActiveRecord::save()
                'autoDelete' => true, // when true then uploaded file will deleted before ActiveRecord::delete()
            ],
        ];
    }

}
