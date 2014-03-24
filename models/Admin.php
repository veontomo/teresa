<?php

namespace app\models;

/**
 * This is the model class for table "teresa_admin".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $avatar
 * @property string $loginName
 * @property string $pswd
 * @property integer $addedBy
 * @property string $creationTime
 * @property integer $updatedBy
 * @property string $updateTime
 * @property string $lastLogin
 *
 * @property Admin $updatedBy0
 * @property Admin[] $admins
 * @property Admin $addedBy0
 * @property TeresaCategory[] $teresaCategories
 * @property TeresaCategoryProduct[] $teresaCategoryProducts
 * @property TeresaManufacturer[] $teresaManufacturers
 * @property TeresaProduct[] $teresaProducts
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teresa_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'loginName', 'pswd', 'creationTime'], 'required'],
            [['addedBy', 'updatedBy'], 'integer'],
            [['creationTime', 'updateTime', 'lastLogin'], 'safe'],
            [['name', 'surname'], 'string', 'max' => 50],
            [['avatar'], 'string', 'max' => 200],
            [['loginName'], 'string', 'max' => 20],
            [['pswd'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'ID'),
            'name' => \Yii::t('app', 'Name'),
            'surname' => \Yii::t('app', 'Surname'),
            'avatar' => \Yii::t('app', 'Avatar'),
            'loginName' => \Yii::t('app', 'Login Name'),
            'pswd' => \Yii::t('app', 'Pswd'),
            'addedBy' => \Yii::t('app', 'Added By'),
            'creationTime' => \Yii::t('app', 'Creation Time'),
            'updatedBy' => \Yii::t('app', 'Updated By'),
            'updateTime' => \Yii::t('app', 'Update Time'),
            'lastLogin' => \Yii::t('app', 'Last Login'),
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
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['addedBy' => 'id']);
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
    public function getTeresaCategories()
    {
        return $this->hasMany(TeresaCategory::className(), ['addedBy' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaCategoryProducts()
    {
        return $this->hasMany(TeresaCategoryProduct::className(), ['addedBy' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaManufacturers()
    {
        return $this->hasMany(TeresaManufacturer::className(), ['addedBy' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaProducts()
    {
        return $this->hasMany(TeresaProduct::className(), ['addedBy' => 'id']);
    }
}
