<?php
/**
 * User: Vah
 * Date: 19.10.2015
 */

foreach($articles as $a):?>
    <li class="article article__small">
        <h2 class="article_title__small">
            <a class="article_link" href="/blog/view/<?=$a['url']?>"><?=$a['topic']?></a>
        </h2>

        <div class="article_top__small">
            <ul>
                <li class="article_date"><i class="fa fa-calendar"></i>&nbsp;<?=$a['humanDate']?></li>
                <li class="article_blog"><i class="fa fa-newspaper-o"></i>&nbsp;
                    <a href="/blog/<?=$a['blog']['url']?>"><?=$a['blog']['name']?></a></li>
                <li class="article_author">
                    <i class="fa fa-pencil"></i>&nbsp;<?=$a['author']['fname'] .' '. $a['author']['lname']?>
                    <!--<a href="/blog/author/<?#=$a['author']['nick']?>" title="Все материалы этого автора">__</a>-->
                </li>
                <li class="article_count"><i class="fa fa-eye"></i> Просмотров:&nbsp;<?=$a['views']?></li>
            </ul>
        </div>

        <div class="clearfix"></div>

        <div class="article_note__small">
            <p><?=$a['note']?></p>
        </div>

        <div class="article_bottom">
            <a class="btn btn-default btn-sm pull-right" href="/blog/view/<?=$a['url']?>"
               title="Ознакомиться со статьей">Читать далее&hellip;</a>
        </div>

        <div class="clearfix"></div>
    </li>
<?endforeach;?>