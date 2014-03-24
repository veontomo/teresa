<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teresa_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property string $description
 * @property integer $addedBy
 * @property string $creationTime
 * @property integer $updatedBy
 * @property string $updateTime
 *
 * @property TeresaAdmin $updatedBy0
 * @property TeresaAdmin $addedBy0
 * @property TeresaCategoryProduct $teresaCategoryProduct
 * @property TeresaProduct[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teresa_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'addedBy', 'updatedBy'], 'integer'],
            [['description'], 'string'],
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
            'parent' => Yii::t('app', 'Parent'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeresaCategoryProduct()
    {
        return $this->hasOne(TeresaCategoryProduct::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(TeresaProduct::className(), ['id' => 'product_id'])->viaTable('teresa_category_product', ['category_id' => 'id']);
    }
}
