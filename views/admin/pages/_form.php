<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?> <div class="pages-form"> <?php $form = ActiveForm::begin(); ?> <?= $form->field($model, 'blog_id')->textInput(['maxlength' => 10]) ?> <?= $form->field($model, 'author_id')->textInput(['maxlength' => 10]) ?> <?= $form->field($model, 'set_id')->textInput(['maxlength' => 10]) ?> <?= $form->field($model, 'topic')->textInput(['maxlength' => 255]) ?> <?= $form->field($model, 'note')->textInput(['maxlength' => 400]) ?> <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?> <?= $form->field($model, 'pic')->textInput(['maxlength' => 255]) ?> <?= $form->field($model, 'date')->textInput() ?> <?= $form->field($model, 'views')->textInput(['maxlength' => 10]) ?> <div class="form-group"> <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> </div> <?php ActiveForm::end(); ?> </div>