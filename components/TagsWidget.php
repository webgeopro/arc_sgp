<?php
/**
 * Виджет формирования "облака" тегов для поля "ТЕГИ" левой колонки
 * User: Vah
 * Date: 19.10.2015
 */
namespace app\components;

use yii\base\Widget;
use app\models\Tags;

class TagsWidget extends Widget {

    public $activeTag;
    private $inc;
    public $size_xs;
    public $size_sm;
    public $size_md;
    public $size_lg;

    public function init()
    {
        /*$cnt = Tags::getMaxTagsCount();
        if (0 < $cnt)
            $this->inc = $cnt / 4; //$this->inc = floor($cnt / 4);

        $this->size_xs = floor($this->inc);
        $this->size_sm = floor(2 * $this->inc);
        $this->size_md = floor(3 * $this->inc);
        $this->size_lg = floor(4 * $this->inc);*/
    }

    public function run()
    {
        if ($this->activeTag) {
            $tags = Tags::getAllTags(); // Заглушка пока
        } else
            $tags = Tags::getAllTags(false); // Все теги

        array_walk($tags, function(&$tag){
            #$size = $this->getGroup($tag['cnt']);
            #$tag = '<a class="size-' . $size . '" href="/blog/tag/' .$tag['url'] .'">'.$tag['name']. '</a>';
            $tag = '<a href="/blog/tag/'
                . $tag['url'] . '" title="Поиск материалов по тегу <'
                . $tag['name'] .'>"'
                . (($this->activeTag == $tag['url']) ? ' class="active"' : '')
                . '>'
                . $tag['name'] . '</a>';
        });

        if ($this->activeTag) { // Изменяем title страницы только при работе с тегами (/blog/tag/_имя)
            $this->view->title = 'Поиск материалов по тегу <' . $this->activeTag . '>';
            $paginatorPageId = \Yii::$app->request->get('page');
            if ($paginatorPageId)
                $this->view->title .= ', страница ' . $paginatorPageId;
        }

        return implode(', ', $tags);
    }

    private function getGroup($num)
    {
        if ($this->size_md < $num)
            $size = 'lg';
        elseif ($this->size_sm < $num)
            $size = 'md';
        elseif ($this->size_xs < $num)
            $size = 'sm';
        else
            $size = 'xs';

        return $size;
    }

} 