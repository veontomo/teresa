<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Manufacturer $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Manufacturer',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manufacturers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-create">
	<?php
		echo $model->getLang();
	?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
