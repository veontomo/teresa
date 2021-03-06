<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Manufacturer;

/**
 * ManufacturerSearch represents the model behind the search form about `app\models\Manufacturer`.
 */
class ManufacturerSearch extends Model
{
    public $id;
    public $url;
    public $addedBy;
    public $creationTime;
    public $updatedBy;
    public $updateTime;

    public function rules()
    {
        return [
            [['id', 'addedBy', 'updatedBy'], 'integer'],
            [['url', 'creationTime', 'updateTime'], 'safe'],
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

    public function search($params)
    {
        $query = Manufacturer::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'url', $this->url]);
        $query->andFilterWhere(['addedBy' => $this->addedBy]);
        $query->andFilterWhere(['creationTime' => $this->creationTime]);
        $query->andFilterWhere(['updatedBy' => $this->updatedBy]);
        $query->andFilterWhere(['updateTime' => $this->updateTime]);
        return $dataProvider;
    }
}
