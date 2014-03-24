<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Admin;

/**
 * AdminSearch represents the model behind the search form about `app\models\Admin`.
 */
class AdminSearch extends Model
{
    public $id;
    public $name;
    public $surname;
    public $avatar;
    public $loginName;
    public $pswd;
    public $addedBy;
    public $creationTime;
    public $updatedBy;
    public $updateTime;
    public $lastLogin;

    public function rules()
    {
        return [
            [['id', 'addedBy', 'updatedBy'], 'integer'],
            [['name', 'surname', 'avatar', 'loginName', 'pswd', 'creationTime', 'updateTime', 'lastLogin'], 'safe'],
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
            'surname' => Yii::t('app', 'Surname'),
            'avatar' => Yii::t('app', 'Avatar'),
            'loginName' => Yii::t('app', 'Login Name'),
            'pswd' => Yii::t('app', 'Pswd'),
            'addedBy' => Yii::t('app', 'Added By'),
            'creationTime' => Yii::t('app', 'Creation Time'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'updateTime' => Yii::t('app', 'Update Time'),
            'lastLogin' => Yii::t('app', 'Last Login'),
        ];
    }

    public function search($params)
    {
        $query = Admin::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'name', true);
        $this->addCondition($query, 'surname', true);
        $this->addCondition($query, 'avatar', true);
        $this->addCondition($query, 'loginName', true);
        $this->addCondition($query, 'pswd', true);
        $this->addCondition($query, 'addedBy');
        $this->addCondition($query, 'creationTime');
        $this->addCondition($query, 'updatedBy');
        $this->addCondition($query, 'updateTime');
        $this->addCondition($query, 'lastLogin');
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
