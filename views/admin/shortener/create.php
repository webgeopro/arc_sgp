<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Shortener */

$this->title = 'Сократить url';
$this->params['breadcrumbs'][] = ['label' => 'Shorteners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="shortener-create container"><h1><?= Html::encode($this->title) ?></h1> <?= $this->render('_form_mod', [
        'model' => $model,
    ]) ?> </div>