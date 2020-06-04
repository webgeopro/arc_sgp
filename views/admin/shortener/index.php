<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сокращение url | ' . \Yii::$app->params['titleAdmin'];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="shortener-index" style="padding: 0 20px;"><h1><?= Html::encode($this->title) ?></h1><p><?= Html::a('Сократить url', ['create'], [
            'class' => 'btn btn-success pull-right',
            'style' => 'margin-bottom: 20px;']) ?> </p> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'short',
            'full',
            'page_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> </div>