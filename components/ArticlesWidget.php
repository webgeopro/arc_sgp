<?php
/**
 * Отображение списка статей раздела / подраздела
 * User: Vah
 * Date: 15.10.2015
 */
namespace app\components;

use yii\base\Widget;
use yii\data\Pagination;
use app\models\Blog;
use app\models\Pages;
use app\models\Authors;
use app\models\Tags;

class ArticlesWidget extends Widget {

    public $activeUrl; // Выбранный пункт меню
    public $activeSubUrl; // Выбранный подпункт меню
    public $activeChildId; // Все подпункты текущего пункта меню
    public $activeTag; // Выбранный тег
    public $activeSet; // Выбранный "рекомендуемы набор"
    private $page;
    private $pageSize = 2;

    public function init()
    {
        parent::init();
        if ($this->activeSubUrl)
            $this->page = Blog::getPageByUrl($this->activeSubUrl); // Получить страницу по url
        else {
            $this->page = Blog::getPageByUrl($this->activeUrl); // Получить страницу по url
        }
        #die(print_r($this->page));
        #die("\$activeUrl=$this->activeUrl : \$activeSubUrl=$this->activeSubUrl : \$activeChildId=$this->activeChildId : \$activeTag=$this->activeTag.");
    }

    public function run()
    {
        $pages = new Pages;
        if (isset($this->page['id'])) {
            $this->activeChildId = Blog::getChildId($this->page['id']);
            $query = (null != $this->activeChildId)
                ? $pages->find()->where(['blog_id' => $this->activeChildId])
                : $pages->find()->where(['blog_id' => $this->page['id']]);
        } elseif ($this->activeTag) {
            $pagesIds = Tags::getPagesIdsByTag($this->activeTag); #die(print_r($pagesIds));
            $query = (null == $pagesIds)
                ? $pages->find()
                : $pages->find()->where(['id' => $pagesIds]); #die(print_r($query));
            $route = '/blog/tag/' . $this->activeTag; // для красивого url у тегов
        } else
            $query = $pages->find();

        $countQuery = clone $query;
        $totalCount = $countQuery->count();
        $pages = new Pagination([
                'totalCount' => $totalCount,
                'pageSize' => 1, #$this->pageSize,
                'pageSizeParam' => false,
                'forcePageParam' => false,
            ]);
        if (!empty($route)) { // Небольшие правки для красивого url у тегов
            $pages->route = isset($route) ? $route : null;
            $pages->params = [
                'page' => \Yii::$app->request->get('page', 1),
                //'tag' => \Yii::$app->request->get('tag'),
            ];
            $pages->forcePageParam = false;
        }
        $articles = $query
            ->select(['blog_id', 'author_id', 'topic', 'note', 'pic', 'views', 'date', 'url'])
            ->with('author', 'blog')
            ->orderBy('date DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            //->asArray()
            ->all();

        return $this->render('article', [
                'articles' => $articles,
                'pages' => $pages,
                'page' => $this->page,
                'oneArticle' => ($this->pageSize <= $totalCount) ? '' : 'one-article',
                //'isRoot' => empty($this->page['isRoot']) ? '' : '1',
            ]);
    }

} 