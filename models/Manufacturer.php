<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teresa_manufacturer".
 *
 * @property string $id
 * @property string $url
 * @property integer $addedBy
 * @property string $creationTime
 * @property integer $updatedBy
 * @property string $updateTime
 *
 * @property TeresaAdmin $updatedBy0
 * @property TeresaAdmin $addedBy0
 * @property TeresaManufacturerValues $teresaManufacturerValues
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teresa_manufacturer';
    }

    /**
    * Name of the table containing attributes that depened on language
    * @return 'teresa_manufacturer_attrs'
    */
    public static function tableAttrs(){
        return 'teresa_manufacturer_attrs';
    }

    /**
    * Name of the table containing translations of the attributes
    * @return 'teresa_manufacturer_values'
    */
    public static function tableValues(){
        return 'teresa_manufacturer_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['addedBy', 'updatedBy'], 'integer'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
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
        return $this->hasOne(Admin::className(), ['id' => 'updatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddedBy0()
    {
        return $this->hasOne(Admin::className(), ['id' => 'addedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaManufacturerValues()
    {
        return $this->hasOne(TeresaManufacturerValues::className(), ['id' => 'id']);
    }
}
