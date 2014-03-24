<?php

namespace app\models;

/**
 * This is the model class for table "teresa_product".
 *
 * @property string $id
 * @property string $name
 * @property string $manufacturer
 * @property string $description
 * @property string $mass
 * @property integer $lenght
 * @property integer $width
 * @property integer $height
 * @property integer $addedBy
 * @property string $creationTime
 * @property integer $updatedBy
 * @property string $updateTime
 *
 * @property TeresaCategoryProduct $teresaCategoryProduct
 * @property TeresaCategory[] $categories
 * @property TeresaAdmin $updatedBy0
 * @property TeresaAdmin $addedBy0
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teresa_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manufacturer', 'lenght', 'width', 'height', 'addedBy', 'updatedBy'], 'integer'],
            [['description'], 'string'],
            [['mass'], 'number'],
            [['creationTime'], 'required'],
            [['creationTime', 'updateTime'], 'safe'],
            [['name'], 'string', 'max' => 255]
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
            'manufacturer' => Yii::t('app', 'Manufacturer'),
            'description' => Yii::t('app', 'Description'),
            'mass' => Yii::t('app', 'Mass'),
            'lenght' => Yii::t('app', 'Lenght'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'addedBy' => Yii::t('app', 'Added By'),
            'creationTime' => Yii::t('app', 'Creation Time'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'updateTime' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaCategoryProduct()
    {
        return $this->hasOne(TeresaCategoryProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(TeresaCategory::className(), ['id' => 'category_id'])->viaTable('teresa_category_product', ['product_id' => 'id']);
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
