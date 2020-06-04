<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Shortener */
/* @var $form yii\widgets\ActiveForm */
?> <script type="text/javascript">var urls = <?=json_encode(\app\models\Pages::getAllPagesUrlMap())?> function generateLink()
    {
        var newLink = Math.random().toString(36).slice(-3);;
        document.getElementById('shortener-short').value = newLink;
        return false;
    }
    function setLink()
    {
        var index = document.getElementById('pages-id').value;
        document.getElementById('shortener_url').value = urls[index];
        return false;
    }
    function getPageId(ob)
    {
        var newElement;
        newElement = document.getElementById('shortener-page_id').value;
        document.getElementById('pages-id').value = newElement;
        document.getElementById('pages-url').value = urls[newElement];
    }</script><div class="shortener-form"> <?php $form = ActiveForm::begin(); ?> <div class="row" style="margin-bottom: 10px;"><div class="col-md-9"> <?=$form->field($model, 'full')->textInput([
                'maxlength' => 100, 'id' => 'shortener_url',
            ])->label('Shortener Url');
            ?> </div><div class="col-md-3"><label class="control-label" for="pages-url">Shortener Short Url</label><div class="input-group" style="margin-top: -10px;"> <?= $form->field($model, 'short')->textInput(['maxlength' => 3])->label(false) ?> <span class="input-group-btn" style="vertical-align: bottom;"><button class="btn btn-primary btn__short" type="button" onclick="return generateLink()">Латиница</button></span></div></div></div><hr> <?# if($model->isNewRecord):?> <div class="row"><div class="col-md-1"> <?= ($model->isNewRecord)
                ? '<label class="control-label" for="pages-id">Page ID</label>'
                  . Html::input('text', 'Pages[id]', null, ['id'=>'pages-id', 'class'=>'form-control'])
                : $form->field($model->page, 'id')->label('Page ID');?> </div><div class="col-md-5"> <?=$form->field($model, 'page_id')
                ->dropdownList(\app\models\Pages::getAllPagesMap($model->page),[
                    'onchange' => 'getPageId(this)', 'prompt' => '-- Выберите статью --'
                ])->label('Shortener page_id')?> </div><div class="col-md-6"><label class="control-label" for="pages-url">Page Url</label><div class="input-group" style="margin-top: -10px;"> <?= ($model->isNewRecord)
                    ? Html::input('text', 'Pages[url]', null, [
                            'id'=>'pages-url', 'class'=>'form-control', 'style'=>'margin-top:10px;'])
                    : $form->field($model->page, 'url')->textInput(['maxlength' => 150])->label(false);?> <span class="input-group-btn" style="vertical-align: bottom;"><button class="btn btn-primary btn_page-url" type="button" onclick="return setLink()">Выбрать</button></span></div></div></div><hr><div class="form-group"> <?= Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update', [
                'class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-danger'). ' pull-right',
            ]) ?> <?= Html::a('<< Назад', Html::encode('/admin/pages'), ['class' => 'btn btn-info']) ?> </div> <?php ActiveForm::end(); ?> </div>