<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Model
{
    public $id;
    public $name;
    public $manufacturer;
    public $description;
    public $mass;
    public $lenght;
    public $width;
    public $height;
    public $addedBy;
    public $creationTime;
    public $updatedBy;
    public $updateTime;

    public function rules()
    {
        return [
            [['id', 'manufacturer', 'lenght', 'width', 'height', 'addedBy', 'updatedBy'], 'integer'],
            [['name', 'description', 'creationTime', 'updateTime'], 'safe'],
            [['mass'], 'number'],
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

    public function search($params)
    {
        $query = Product::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'name', true);
        $this->addCondition($query, 'manufacturer');
        $this->addCondition($query, 'description', true);
        $this->addCondition($query, 'mass');
        $this->addCondition($query, 'lenght');
        $this->addCondition($query, 'width');
        $this->addCondition($query, 'height');
        $this->addCondition($query, 'addedBy');
        $this->addCondition($query, 'creationTime');
        $this->addCondition($query, 'updatedBy');
        $this->addCondition($query, 'updateTime');
        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
