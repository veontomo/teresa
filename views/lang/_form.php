<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Lang $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="lang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'addedBy')->textInput() ?>

    <?= $form->field($model, 'updatedBy')->textInput() ?>

    <?= $form->field($model, 'creationTime')->textInput() ?>

    <?= $form->field($model, 'updateTime')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'charset')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'lang')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
