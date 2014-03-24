<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Manufacturer;

/**
 * ManufacturerSearch represents the model behind the search form about `app\models\Manufacturer`.
 */
class ManufacturerSearch extends Model
{
    public $id;
    public $fullName;
    public $shortName;
    public $url;
    public $description;
    public $addedBy;
    public $creationTime;
    public $updatedBy;
    public $updateTime;

    public function rules()
    {
        return [
            [['id', 'addedBy', 'updatedBy'], 'integer'],
            [['fullName', 'shortName', 'url', 'description', 'creationTime', 'updateTime'], 'safe'],
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

    public function search($params)
    {
        $query = Manufacturer::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'fullName', true);
        $this->addCondition($query, 'shortName', true);
        $this->addCondition($query, 'url', true);
        $this->addCondition($query, 'description', true);
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
