<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?> <div class="comments-index"><h1><?= Html::encode($this->title) ?></h1><p> <?= Html::a('Create Comments', ['create'], ['class' => 'btn btn-success']) ?> </p> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'page_id',
            'name',
            'content',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> </div>