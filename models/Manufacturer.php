<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teresa_manufacturer".
 *
 * @property string $id
 * @property string $fullName
 * @property string $shortName
 * @property string $url
 * @property string $description
 * @property integer $addedBy
 * @property string $creationTime
 * @property integer $updatedBy
 * @property string $updateTime
 *
 * @property TeresaAdmin $updatedBy0
 * @property TeresaAdmin $addedBy0
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['addedBy', 'updatedBy'], 'integer'],
            [['creationTime'], 'required'],
            [['creationTime', 'updateTime'], 'safe'],
            [['fullName'], 'string', 'max' => 150],
            [['shortName'], 'string', 'max' => 30],
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
            'fullName' => Yii::t('app', 'Full Name'),
            'shortName' => Yii::t('app', 'Short Name'),
            'url' => Yii::t('app', 'Url'),
            'description' => Yii::t('app', 'Description'),
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
}
