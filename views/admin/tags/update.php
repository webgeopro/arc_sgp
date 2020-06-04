<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tags */

$this->title = '#'. $model->id .'. ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?> <div class="tags-update container"><h1><?= Html::encode($this->title) ?></h1> <?= $this->render('_form_mod', [
        'model' => $model,
    ]) ?> </div>