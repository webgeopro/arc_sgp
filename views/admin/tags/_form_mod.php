<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tags */
/* @var $form yii\widgets\ActiveForm */
?> <div class="tags-form"> <?php $form = ActiveForm::begin(); ?> <div class="row"><div class="col-sm-5"> <?= $form->field($model, 'name')->textInput(['maxlength' => 15]) ?> </div><div class="col-sm-7"><div><label class="control-label" for="tags-url">Url</label></div><div class="input-group" style="margin-top: -10px;"> <?= $form->field($model, 'url')->textInput(['maxlength' => 100])->label(false) ?> <span class="input-group-btn" style="vertical-align: bottom;"><button class="btn btn-primary btn_tag__latin" type="button">Латиница</button></span></div></div></div><hr><div class="form-group"><div class="form-group"> <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', [
                    'class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-danger') . ' pull-right'
                ]) ?> <?= Html::a('<< Назад', Html::encode('/admin/tags'), ['class' => 'btn btn-info']) ?> </div></div> <?php ActiveForm::end(); ?> </div>