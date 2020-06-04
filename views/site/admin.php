<?php
/**
 * User: Vah
 * Date: 22.10.2015
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = \Yii::$app->params['titleAdmin'];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="container"><div class="admin_title"><h1 class="pull-left"><?=$this->title?></h1><a href="<?= Url::to(['site/logout'])?>" data-method="post" class="btn btn-danger btn-lg pull-right" style="margin-top: 20px;">LOGOUT</a></div><div class="clearfix"></div><hr><div class="row"><div class="col-md-6"><h3>Разделы</h3><a href="/admin/blog" class="btn btn-info">Редактировать разделы</a></div><div class="col-md-6"><h3>Статьи</h3><a href="/admin/pages" class="btn btn-info">Редактировать статьи</a></div></div><div class="row"><div class="col-md-6"><h3>Теги</h3><a href="/admin/tags" class="btn btn-info">Редактировать теги</a></div><div class="col-md-6"><h3>Авторы</h3><a href="/admin/authors" class="btn btn-info">Редактировать авторов</a></div></div><div class="row"><div class="col-md-6"><h3>Shortener</h3><a href="/admin/shortener" class="btn btn-info">Сокращение ссылок</a></div></div></div>