<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?> <div class="blog-form"> <?php $form = ActiveForm::begin(); ?> <?= $form->field($model, 'parent_id')->textInput(['maxlength' => 10]) ?> <?= $form->field($model, 'name')->textInput(['maxlength' => 30]) ?> <?= $form->field($model, 'url')->textInput(['maxlength' => 100]) ?> <?= $form->field($model, 'comment')->textInput(['maxlength' => 255]) ?> <div class="form-group"> <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> </div> <?php ActiveForm::end(); ?> </div>