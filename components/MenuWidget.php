<?php
/**
 * Отображение меню категорий для блога
 * Выделение активного пункта + отображение
 * User: Vah
 * Date: 15.10.2015
 */
namespace app\components;

use app\models\Pages;
use yii\base\Widget;
use app\models\Blog;

class MenuWidget extends Widget {

    public $activeUrl; // Выбранный пункт меню
    public $activeSubUrl; // Выбранный пункт меню
    public $activeTag; // Если поиск по тегам
    public $pageId; // Выбранный пункт меню
    private $title; // Заголовок страницы

    public function run()
    {
        if ($this->pageId) {
            $menu = Blog::getSubMenu(null, $this->pageId);
            $blog = Pages::getBlogUrlByPageId($this->pageId);
            $this->activeUrl = $blog['blog']['url'];
            $this->activeSubUrl = $blog['blog']['url'];
            if ($blog['blog']['name'])
                $this->title = $blog['blog']['name'];
        } else {
            $menu = Blog::getSubMenu($this->activeUrl);
            if (empty($activeTag)) // title для тега уже установлен в TagsWidget
                if ($this->activeSubUrl)
                    $this->title = Blog::getPageTitle($this->activeSubUrl);
                else
                    $this->title = Blog::getPageTitle($this->activeUrl);
        }
        /* Формирование title страницы (раздела/подраздела)*/
        if ($this->title) // title страницы
            $this->title .= ' | ' . \Yii::$app->params['titleBlog'];
        else
            $this->title = \Yii::$app->params['titleBlogDefault'];
        $paginatorPageId = \Yii::$app->request->get('page');
        if ($paginatorPageId)
            $this->title .= ', страница ' . $paginatorPageId;

        return $this->render(
            'menu',
            [
                'links' => $menu,
                'activeLink' => $this->activeUrl,
                'activeSubLink' => $this->activeSubUrl,
                'title' => $this->title,
            ]
        );
    }

} 