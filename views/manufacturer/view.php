<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Manufacturer $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manufacturers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-view">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

        <?php
            echo 'lang from Polyglot component: ' . Yii::$app->polyglot->getLang()->name . '<br />';
            echo 'lang from model: ' . $model->getLang()->name . '<br />';
            // echo 'getTeresaManufacturerValues from model: ' . $model->getTeresaManufacturerValues() . '<br />';
            echo 'from model id: ' . $model->id . '<br />';
            print_r($model->getValues());

        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'url:url',
            'addedBy',
            'creationTime',
            'updatedBy',
            'updateTime',
        ],
    ]) ?>

</div>
