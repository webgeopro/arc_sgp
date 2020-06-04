<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Теги | ' . \Yii::$app->params['titleAdmin'];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="tags-index container"><h1><?= Html::encode($this->title) ?></h1><p><?= Html::a('Новый тег', ['create'], [
                'class' => 'btn btn-success pull-right',
                'style' => 'margin-bottom: 20px;']) ?> </p> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' =>'url',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(
                        Html::encode($model->url),
                        '/blog/tag/'. $model->url,
                        ['target' => '_blank']
                    );
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> </div>