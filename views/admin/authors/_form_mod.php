<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Authors */
/* @var $form yii\widgets\ActiveForm */
?> <div class="authors-form"> <?php $form = ActiveForm::begin(); ?> <div class="row"><div class="col-sm-4"> <?= $form->field($model, 'fname')->textInput(['maxlength' => 30]) ?> </div><div class="col-sm-4"> <?= $form->field($model, 'lname')->textInput(['maxlength' => 50]) ?> </div><div class="col-sm-3"> <?= $form->field($model, 'nick')->textInput(['maxlength' => 15]) ?> </div><div class="col-sm-1"> <?= $form->field($model, 'ratings')->textInput(['maxlength' => 10]) ?> </div></div> <?= $form->field($model, 'avatar')->textInput(['maxlength' => 50]) ?> <?= $form->field($model, 'comment')->textInput(['maxlength' => 255]) ?> <div class="form-group"> <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', [
                'class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' pull-right'
            ]) ?> <?= Html::a('<< Назад', Html::encode('/admin/authors'), ['class' => 'btn btn-info']) ?> </div> <?php ActiveForm::end(); ?> </div>