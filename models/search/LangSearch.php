<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lang;

/**
 * LangSearch represents the model behind the search form about `app\models\Lang`.
 */
class LangSearch extends Model
{
    public $id;
    public $name;
    public $description;
    public $charset;
    public $status;
    public $lang;
    public $addedBy;
    public $creationTime;
    public $updatedBy;
    public $updateTime;

    public function rules()
    {
        return [
            [['id', 'addedBy', 'updatedBy'], 'integer'],
            [['name', 'description', 'charset', 'status', 'lang', 'creationTime', 'updateTime'], 'safe'],
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

    public function search($params)
    {
        $query = Lang::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'description', $this->description]);
        $query->andFilterWhere(['like', 'charset', $this->charset]);
        $query->andFilterWhere(['like', 'status', $this->status]);
        $query->andFilterWhere(['like', 'lang', $this->lang]);
        $query->andFilterWhere(['addedBy' => $this->addedBy]);
        $query->andFilterWhere(['creationTime' => $this->creationTime]);
        $query->andFilterWhere(['updatedBy' => $this->updatedBy]);
        $query->andFilterWhere(['updateTime' => $this->updateTime]);
        return $dataProvider;
    }
}
