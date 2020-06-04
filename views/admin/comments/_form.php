<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */
/* @var $form yii\widgets\ActiveForm */
?> <div class="comments-form"> <?php $form = ActiveForm::begin(); ?> <?= $form->field($model, 'page_id')->textInput(['maxlength' => 10]) ?> <?= $form->field($model, 'name')->textInput(['maxlength' => 40]) ?> <?= $form->field($model, 'content')->textInput(['maxlength' => 500]) ?> <?= $form->field($model, 'date')->textInput() ?> <div class="form-group"> <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> </div> <?php ActiveForm::end(); ?> </div>