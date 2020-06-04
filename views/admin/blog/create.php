<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Blog */

$this->title = 'Создать раздел';
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="blog-create container"><h1><?= Html::encode($this->title) ?></h1> <?= $this->render('_form_mod', [
        'model' => $model,
        'blogs' => $blogs,
    ]) ?> </div>