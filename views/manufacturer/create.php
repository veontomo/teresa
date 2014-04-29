<?php

use yii\helpers\Html;
use yii\web\Session;

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
	 	echo 'lang from Polyglot component: ' . Yii::$app->polyglot->getLang()->name . '<br />';
	 	echo 'lang from model: ' . $model->getLang()->name . '<br />';
	 	// echo 'getTeresaManufacturerValues from model: ' . $model->getTeresaManufacturerValues() . '<br />';
	 	echo 'from model id: ' . $model->id . '<br />'

	?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
