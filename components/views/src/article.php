<?php
/**
 * User: Vah
 * Date: 15.10.2015
 */
use yii\widgets\LinkPager;

echo '<ul class="articles">';

if (null == $articles) {
    echo $this->render('/blog/_empty');
}
foreach($articles as $article)
    echo $this->render('_article', ['a' => $article, 'oneArticle'=> $oneArticle]);

echo '</ul>';

echo
    '<div class="articles_pagination">'
    . LinkPager::widget([
            'pagination' => $pages,
            'nextPageLabel' => 'Вперед »',
            'prevPageLabel' => '« Назад',
        ])
    . '</div>'

?>
