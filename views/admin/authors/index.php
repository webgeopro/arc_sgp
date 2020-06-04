<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторы блога | ' . \Yii::$app->params['titleAdmin'];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="authors-index" style="padding: 0 50px;"><h1><?= Html::encode($this->title) ?></h1><p><?= Html::a('Новый автор', ['create'], [
                'class' => 'btn btn-success pull-right',
                'style' => 'margin-bottom: 20px;']) ?> </p> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fname',
            'lname',
            'nick',
            'avatar',
            'ratings',
            'comment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> </div>