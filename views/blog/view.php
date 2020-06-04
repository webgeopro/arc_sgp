<?php
    use app\components\MenuWidget;

    $this->title = $page['topic'] .' | '. \Yii::$app->params['titleBlog'];
    $this->registerCssFile('/css/add-blog.min.css', ['depends'=>['app\assets\AppAsset',]]);
    echo $this->render('_begin');?> <section class="blog container"><div class="row"> <?######################### LEFT_PANEL #####################?> <div class="col-md-3 well-left"><nav class="nav-left"> <?= MenuWidget::widget([
                        'pageId' => $page->id,
                    ])?> </nav><hr><aside><div class="h2-requisites">РЕКОМЕНДУЕМ</div><div class="well well-sm"><div class="h4-address"></div></div><div class="h2-requisites">ТЕГИ</div><div class="well well-sm"><div class="h4-address"></div></div></aside></div> <?######################### /LEFT_PANEL #####################?> <?######################### CONTENT #####################?> <div class="col-md-9"><div class="jumbotron"><ul class="articles"> <?=$this->render('_view', ['a'=>$page]);?> </ul></div></div> <?######################### /CONTENT #####################?> </div></section> <?echo $this->render('_end');?>