<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Admin $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Admin',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
