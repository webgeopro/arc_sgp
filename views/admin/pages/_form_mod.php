<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?> <div class="pages-form"> <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?> <div class="row"><div class="col-sm-3"> <?= $form->field($model, 'blog_id')->dropDownList($blogs) ?> </div><div class="col-sm-3"> <?= $form->field($model, 'author_id')->dropDownList($authors) ?> </div><div class="col-sm-6"><div><label class="control-label" for="pages-url">Адрес</label></div><div class="input-group" style="margin-top: -10px;"> <?= $form->field($model, 'url')->textInput(['maxlength' => 150])->label(false) ?> <span class="input-group-btn" style="vertical-align: bottom;"><button class="btn btn-primary btn__latin" type="button">Латиница</button></span></div></div></div> <?= $form->field($model, 'topic')->textInput(['maxlength' => 255]) ?> <?= $form->field($model, 'note')->textarea(['maxlength' => 400, 'rows' => 3]) ?> <?= $form->field($model, 'content')->widget(vova07\imperavi\Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageManagerJson' => Url::to(['/admin/pages/images-get']),
            'plugins' => ['clips', 'fullscreen', 'imagemanager', 'table', 'video', 'inlinestyle', 'fontcolor'],
        ]
    ]);?> <div class="row"><div class="col-sm-6"> <?= $form->field($model, 'pic')->textInput(['maxlength' => 255]) ?> </div><div class="col-sm-6"> <?= $form->field($model, 'file')->fileInput() ?> </div></div><div class="row"><div class="col-sm-2"> <?= $form->field($model, 'date')->widget(DatePicker::className(),
                ['dateFormat' => 'yyyy-MM-dd'], ['class'=>'form-control'])?> </div><div class="col-sm-1"> <?= $form->field($model, 'views')->textInput(['maxlength' => 10]) ?> </div><div class="col-sm-9"><label class="control-label" for="btn-group">Теги</label><br><div class="row"><span class="col-md-3"><div class="input-group"> <?=Html::dropDownList('selectTag', null, \app\models\Tags::getAllTagsMap($model->tags),
                            ['id'=>'adminTagSelect', 'class'=>'form-control'])?> <span class="input-group-btn"><a href="<?=Url::to(['/admin/pages/tag-add', 'page_id'=>$model['id']])?>" id="adminTagAdd" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i></a></span></div></span><!--<div class="col-md-10">--> <?foreach($model->tags as $tag) {
                    $btn = '<div class="btn-group" style="margin-right:15px;">';
                    $btn.= '<span class="btn btn-default">' . $tag['name'] . '</span>';
                    $btn.= Html::a('<i class="fa fa-times-circle"></i>',
                        Url::to(['/admin/pages/tag-delete', 'tag_id'=>$tag['id'], 'page_id'=>$model['id']]),
                        ['class'=>'btn btn-danger', 'title'=>'Удалить тег <'. $tag['name'] .'>']);
                    $btn.= '</div>';

                    echo $btn;}?> <!--</div>--></div> <?/*= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => $model->getTags(),
                    'pagination' => false,
                ]),
                'columns' => [
                    'name',
                    ['label' =>'Url','format' => 'raw',
                    'value' => function($model){
                        return Html::a(Html::encode($model->url), '/blog/tag/'.$model->url,['target' => '_blank']);
                    },
                        'header' => $form->field($model, 'tags')->listBox(\app\models\Tags::getAllTagsMap())->label(false),
                    ],
                    ['class' => 'yii\grid\ActionColumn', 'controller' => 'admin/tags',
                     'header' => Html::a('<i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Добавить', ['admin/tags/create']),
                    ],
                ]
            ]);*/?> </div></div><div class="form-group"> <?= Html::submitButton(
            $model->isNewRecord ? 'Create' : 'Update', [
                'class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-danger'). ' pull-right',
            ]) ?> <?= Html::a('<< Назад', Html::encode('/admin/pages'), ['class' => 'btn btn-info']) ?> </div> <?php ActiveForm::end(); ?> </div><hr><div class="container"><img src="/uploads/blog/<?=$model->pic?>" data-image-src="/uploads/blog/" alt="" class="img-responsive" id="img-preview"></div>