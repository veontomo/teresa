<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Admin $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'loginName')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'pswd')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'creationTime')->textInput() ?>

    <?= $form->field($model, 'addedBy')->textInput() ?>

    <?= $form->field($model, 'updatedBy')->textInput() ?>

    <?= $form->field($model, 'updateTime')->textInput() ?>

    <?= $form->field($model, 'lastLogin')->textInput() ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
