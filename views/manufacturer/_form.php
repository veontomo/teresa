<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Manufacturer $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="manufacturer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shortName')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'fullName')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
