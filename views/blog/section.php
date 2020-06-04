<?php
    use app\components\MenuWidget;
    use app\components\ArticlesWidget;
    use app\components\TagsWidget;
    $this->title = \Yii::$app->params['titleBlogDefault'];
    $this->registerCssFile('/css/add-blog.min.css', ['depends'=>['app\assets\AppAsset',]]);
    echo $this->render('_begin');?> <section class="blog container"><div class="row"> <?######################### LEFT_PANEL #####################?> <div class="col-md-3 well-left"><nav class="nav-left"> <?= MenuWidget::widget([
                        'activeUrl' => empty($activeLink)?'':$activeLink,
                        'activeSubUrl' => empty($activeSubLink)?'':$activeSubLink,
                        'activeTag' => empty($activeTag)?'':$activeTag, /* Для изменения title */
                    ])?> </nav><hr><aside> <?/*<div class="h2-requisites">РЕКОМЕНДУЕМ</div>
                <div class="well well-sm"><div class="h4-address"></div></div>*/?> <div class="h2-requisites">ТЕГИ</div><div class="well well-sm"><div class="h4-address"> <?=TagsWidget::widget(['activeTag' => empty($activeTag)?'':$activeTag, ])?> </div></div></aside></div> <?######################### /LEFT_PANEL #####################?> <?######################### CONTENT #####################?> <div class="col-md-9"><div class="jumbotron"> <?= ArticlesWidget::widget([
                    'activeUrl' => empty($activeLink)?'':$activeLink,
                    'activeSubUrl' => empty($activeSubLink)?'':$activeSubLink,
                    'activeTag' => empty($activeTag)?'':$activeTag,
                ])?> </div></div> <?######################### /CONTENT #####################?> </div></section> <?echo $this->render('_end');?>