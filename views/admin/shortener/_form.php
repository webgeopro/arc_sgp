<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Shortener */
/* @var $form yii\widgets\ActiveForm */
?> <div class="shortener-form"> <?php $form = ActiveForm::begin(); ?> <?= $form->field($model, 'short')->textInput(['maxlength' => 3]) ?> <?= $form->field($model, 'full')->textInput(['maxlength' => 100]) ?> <?= $form->field($model, 'page_id')->textInput() ?> <div class="form-group"> <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> </div> <?php ActiveForm::end(); ?> </div>