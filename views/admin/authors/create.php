<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Authors */

$this->title = 'Новый автор';
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="authors-create container"><h1><?= Html::encode($this->title) ?></h1> <?= $this->render('_form_mod', [
        'model' => $model,
    ]) ?> </div>