<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */

$this->title = '#'. $model->id .'. ' . ((0 == $model->parent_id)?'':$model->parent->name.' / ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?> <div class="blog-update container"><h1><?= Html::encode($this->title) ?></h1> <?= $this->render('_form_mod', [
        'model' => $model,
        'blogs' => $blogs,
    ]) ?> </div>