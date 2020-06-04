<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Разделы блога | ' . \Yii::$app->params['titleAdmin'];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="blog-index" style="padding: 0 20px;"><h1><?= Html::encode($this->title) ?></h1><p><?= Html::a('Создать раздел', ['create'], [
        'class' => 'btn btn-success pull-right',
        'style' => 'margin-bottom: 20px;']) ?> </p> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            /*'parent_id',*/
            [
                'attribute' =>'parent_id',
                'label' =>'Родитель',
                'value' => function($model){
                    return isset($model->parent->id)
                        ? ((0 == $model->parent->id) ? '/' : $model->parent->name)
                        : '/';
                }
            ],
            'name',
            [
                'attribute' =>'url',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(
                        Html::encode($model->url),
                        '/blog/'. ((0 == $model->parent_id)?'':$model->parent->url.'/') . $model->url,
                        ['target' => '_blank']
                    );
                }
            ],
            'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> </div>