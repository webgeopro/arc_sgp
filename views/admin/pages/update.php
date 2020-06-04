<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */

$this->title = '#'. $model->id .'. ' . $model->topic;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?> <div class="pages-update container"><h1><?= Html::encode($this->title) ?></h1><hr> <?= $this->render('_form_mod', [
        'model'  => $model,
        'blogs'  => $blogs,
        'authors'=> $authors,
    ]) ?> </div>