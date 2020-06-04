<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Shortener */

$this->title = '#'. $model->id .'. ' /*.$model->page->name*/;
$this->params['breadcrumbs'][] = ['label' => 'Shorteners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?> <div class="shortener-update container"><h1><?= Html::encode($this->title) ?></h1> <?= $this->render('_form_mod', [
        'model' => $model,
    ]) ?> </div>