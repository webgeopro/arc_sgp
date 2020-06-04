<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи блога | ' . \Yii::$app->params['titleAdmin'];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="pages-index" style="padding: 0 20px;"><h1>Статьи блога</h1><p><?= Html::a('Новая статья', ['create'], [
            'class' => 'btn btn-success pull-right',
            'style' => 'margin-bottom: 20px;'
    ])?></p> <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['label' =>'Раздел','value' => 'blog.name'],
            [
                'label' =>'Автор',
                'value' => function($model){return $model->author->fname .' '. $model->author->lname;}
            ],
            [
                'label' =>'Теги',
                'format' => 'raw',
                'value' => function($model){
                    $out = '';
                    foreach($model->tags as $tag) {
                        $out .= Html::a(Html::encode($tag['name']),
                            '/blog/tag/' . $tag->url,
                            ['target' => '_blank']) . ', ';
                    }
                    return substr($out, 0, -2);
                }
            ],
            [
                'label' =>'Url',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a(
                        Html::encode($model->url),
                        '/blog/view/' . $model->url,
                        ['target' => '_blank']
                    );
                }
            ],
             'topic',
             'note',
            [
                'attribute' => 'pic',
                'format' => 'raw',
                'value' => function($model){
                    return Html::img(
                        '/uploads/blog/' . $model->pic,
                        ['class' => 'img-responsible','style'=>"width:200px;"]
                    );
                },
            ],
             ['attribute' => 'date', 'options' => ['style'=>"width:100px;"]],
             'views',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> </div>