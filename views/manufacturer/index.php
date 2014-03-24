<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\ManufacturerSearch $searchModel
 */

$this->title = Yii::t('app', 'Manufacturers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Manufacturer',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fullName',
            'shortName',
            'url:url',
            'description:ntext',
            // 'addedBy',
            // 'creationTime',
            // 'updatedBy',
            // 'updateTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
