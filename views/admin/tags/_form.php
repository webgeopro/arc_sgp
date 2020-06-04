<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tags */
/* @var $form yii\widgets\ActiveForm */
?> <div class="tags-form"> <?php $form = ActiveForm::begin(); ?> <?= $form->field($model, 'name')->textInput(['maxlength' => 15]) ?> <?= $form->field($model, 'page_id')->textInput(['maxlength' => 10]) ?> <?= $form->field($model, 'url')->textInput(['maxlength' => 100]) ?> <div class="form-group"> <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> </div> <?php ActiveForm::end(); ?> </div>