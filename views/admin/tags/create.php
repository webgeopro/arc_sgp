<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tags */

$this->title = 'Новый тег';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="tags-create container"><h1><?= Html::encode($this->title) ?></h1> <?= $this->render('_form_mod', [
        'model' => $model,
    ]) ?> </div>