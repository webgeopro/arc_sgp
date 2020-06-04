<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Authors */
/* @var $form yii\widgets\ActiveForm */
?> <div class="authors-form"> <?php $form = ActiveForm::begin(); ?> <?= $form->field($model, 'fname')->textInput(['maxlength' => 30]) ?> <?= $form->field($model, 'lname')->textInput(['maxlength' => 50]) ?> <?= $form->field($model, 'nick')->textInput(['maxlength' => 15]) ?> <?= $form->field($model, 'avatar')->textInput(['maxlength' => 50]) ?> <?= $form->field($model, 'ratings')->textInput(['maxlength' => 10]) ?> <?= $form->field($model, 'comment')->textInput(['maxlength' => 255]) ?> <div class="form-group"> <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> </div> <?php ActiveForm::end(); ?> </div>