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
		// echo $model->getLang()->name;
	 	echo 'lang component: ' . Yii::$app->polyglot->l;
	 	$s = new Session();
	 	$s->open();
	 	print_r($s);
	?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
