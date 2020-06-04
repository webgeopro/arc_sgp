<?php

namespace app\controllers;
use app\models\Pages;
use Yii;
use yii\web\Controller;
use app\models\Blog;
use app\models\Tags;

class BlogController extends Controller
{
    public function actionIndex($tag='')
    {
        return $this->render('section', [
                'links' => Blog::getMenu(),
                'activeTag' => $tag,
            ]);
    }

    /**
     * Отображение раздела/подраздела
     * (Меню + статьи в виджетах)
     *
     * @param string $sectionUrl
     * @param string $subsectionUrl
     * @return mixed
     */
    public function actionSection($sectionUrl='', $subsectionUrl='')
    {
        return $this->render('section', [
                'activeLink' => $sectionUrl,
                'activeSubLink' => $subsectionUrl,
            ]);
    }

    /**
     * Просмотр статьи
     *
     * @param string $articleUrl
     * @return mixed
     */
    public function actionView($articleUrl='')
    {
        if (null == $articleUrl) return $this->redirect('/blog');

        $page = Pages::getPageFullAttrByUrl($articleUrl);
        if (null == $page) return $this->redirect('/blog');

        return $this->render('view', ['page'=>$page]);
    }

    /**
     * Раздел Библиотека
     * (Используется API litres.ru)
     * @return mixed
     */
    public function actionBiblio()
    {
        return $this->render('biblio');
    }

}
