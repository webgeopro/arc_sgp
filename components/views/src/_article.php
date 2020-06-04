<?php
/**
 * User: Vah
 * Date: 16.10.2015
 */
//$this->title .= '123';
?>
<li class="article <?=$oneArticle?>">
    <h2 class="article_title">
        <a class="article_link" href="/blog/view/<?=$a['url']?>"><?=$a['topic']?></a>
    </h2>

    <div class="article_top">
        <ul>
            <li class="article_date"><i class="fa fa-calendar"></i>&nbsp;<?=$a['humanDate']?></li>
            <li class="article_blog"><i class="fa fa-newspaper-o"></i>&nbsp;
                <a href="/blog/<?=empty($page['url'])?'':$page['url'].'/'?><?=$a['blog']['url']?>">
                    <?=$a['blog']['name']?>
                </a>
            </li>
            <li class="article_author">
                <i class="fa fa-pencil"></i>&nbsp;<?=$a['author']['fname'] .' '. $a['author']['lname']?>
                <!--<a href="/blog/author/<?#=$a['author']['nick']?>" title="Все материалы этого автора">...</a>-->
            </li>
            <li class="article_count"><i class="fa fa-eye"></i> Просмотров:&nbsp;<?=$a['views']?></li>
        </ul>
    </div>

    <div class="clearfix"></div>

    <div class="article_pic margin-top-10">
        <a href="/blog/view/<?=$a['url']?>">
            <!--<img class="img-responsive" src="/uploads/blog/<?/*=$a['url']*/?>" alt="<?/*=$a['url']*/?>">-->
            <img class="img-responsive" src="/uploads/blog/no-img.jpg" alt="<?=$a['url']?>">
        </a>
    </div>
    <div class="article_note">
        <p><?=$a['note']?></p>
    </div>
    <div class="article_bottom">
        <a class="btn btn-default btn-lg" href="/blog/view/<?=$a['url']?>"
           title="Ознакомиться со статьей">Читать далее&hellip;</a>
        <a class="article_comments" href="/blog/view/<?=$a['url']?>#comments"
           title="Просмотреть комментарии к статье">Комментарии (15)</a>
    </div>
</li>
