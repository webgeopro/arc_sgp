<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?> <div class="blog-form"> <?php $form = ActiveForm::begin(); ?> <div class="row"><div class="col-sm-3"> <?= $form->field($model, 'parent_id')->dropDownList($blogs) ?> </div><div class="col-sm-4"> <?= $form->field($model, 'name')->textInput(['maxlength' => 30]) ?> </div><div class="col-sm-5"><div><label class="control-label" for="pages-url">Адрес</label></div><div class="input-group" style="margin-top: -10px;"> <?= $form->field($model, 'url')->textInput(['maxlength' => 100])->label(false) ?> <span class="input-group-btn" style="vertical-align: bottom;"><button class="btn btn-primary btn_blog__latin" type="button">Латиница</button></span></div></div></div> <?#= $form->field($model, 'parent_id')->textInput(['maxlength' => 10]) ?> <?= $form->field($model, 'comment')->textInput(['maxlength' => 255]) ?> <div class="form-group"> <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', [
                'class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-danger') . ' pull-right'
            ]) ?> <?= Html::a('<< Назад', Html::encode('/admin/blog'), ['class' => 'btn btn-info']) ?> </div> <?php ActiveForm::end(); ?> </div>