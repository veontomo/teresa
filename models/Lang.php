<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teresa_lang".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $charset
 * @property string $status
 * @property string $lang
 * @property integer $addedBy
 * @property string $creationTime
 * @property integer $updatedBy
 * @property string $updateTime
 *
 * @property TeresaAdmin $updatedBy0
 * @property TeresaAdmin $addedBy0
 * @property TeresaManufacturerValues $teresaManufacturerValues
 */
class Lang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teresa_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['addedBy', 'updatedBy'], 'integer'],
            [['creationTime'], 'required'],
            [['creationTime', 'updateTime'], 'safe'],
            [['name'], 'string', 'max' => 5],
            [['description'], 'string', 'max' => 100],
            [['charset', 'status', 'lang'], 'string', 'max' => 10],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'charset' => Yii::t('app', 'Charset'),
            'status' => Yii::t('app', 'Status'),
            'lang' => Yii::t('app', 'Lang'),
            'addedBy' => Yii::t('app', 'Added By'),
            'creationTime' => Yii::t('app', 'Creation Time'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'updateTime' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy0()
    {
        return $this->hasOne(TeresaAdmin::className(), ['id' => 'updatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy0()
    {
        return $this->hasOne(TeresaAdmin::className(), ['id' => 'addedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaManufacturerValues()
    {
        return $this->hasOne(TeresaManufacturerValues::className(), ['lang' => 'id']);
    }
}
