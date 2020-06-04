<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Authors */

$this->title = '#'. $model->id .'. ' . $model->fname .' '. $model->lname;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?> <div class="authors-update container"><h1><?= Html::encode($this->title) ?></h1> <?= $this->render('_form_mod', [
        'model' => $model,
    ]) ?> </div>