<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pages".
 *
 * @property string $id
 * @property string $blog_id
 * @property string $author_id
 * @property string $set_id
 * @property string $topic
 * @property string $note
 * @property string $content
 * @property string $pic
 * @property string $date
 * @property string $views
 * @property string $url
 *
 * @property Comments[] $comments
 * @property Authors $author
 * @property Blog $blog
 * @property Tags[] $tags
 */
class Pages extends \yii\db\ActiveRecord
{
    public $humanDate; // Преобразование даты в человеческий формат
    public $file; // Для загрузки файлов
    public $_tags; // Для записи новых тегов в TagsPages
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /*public function init()
    {
        parent::init();
        Yii::$app->formatter->locale = 'ru-RU';
    }*/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_id', 'author_id', 'set_id', 'views'], 'integer'],
            [['content'], 'string'],
            [['date'], 'safe'],
            [['topic', 'pic'], 'string', 'max' => 255],
            [['note'], 'string', 'max' => 400],
            [['url'], 'string', 'max' => 150],
            [['url'], 'unique'],
            [['file'], 'file'], //, 'extensions' => 'jpg'
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '#',
            'blog_id' => 'Раздел',
            'author_id' => 'Автор',
            'set_id' => 'Наборы',
            'topic' => 'Заголовок',
            'note' => 'Аннотация',
            'content' => 'Содержимое',
            'pic' => 'Изображение',
            'date' => 'Дата',
            'views' => 'Views',
            'url' => 'Адрес',
            'tags' => 'Теги',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id'])
            ->select(['id', 'fname', 'lname', 'nick']); // Забираем только имя и фамилию автора
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id'])
            ->select(['id', 'name', 'url']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        #return $this->hasMany(Tags::className(), ['page_id' => 'id']);
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])
            ->viaTable('tags_pages', ['page_id' => 'id'])
            ->select(['id', 'url', 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsIds()
    {
        #return $this->hasMany(Tags::className(), ['page_id' => 'id']);
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])
            ->viaTable('tags_pages', ['page_id' => 'id'])
            ->select(['id'])
            ->asArray();
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->humanDate = self::humanDate($this->date);
    }

    public static function humanDate($date)
    {
        $date = Yii::$app->formatter->asDate($date). ' г.';
        //Yii::$app->formatter->locale = 'ru-RU';
        //$date = new \DateTime($date);
        //$date = $date->format('F j, Y');
        return $date;
    }

    public static function getPageByUrl($url)
    {
        return self::find()
            ->where(['url'=>$url])
            ->select(['id', 'blog_id', 'author_id', 'topic', 'views', 'date', 'content', 'url'])
            ->with('author', 'blog')
            ->one();
    }

    public static function getPageFullAttrByUrl($url)
    {
        return self::find()
            ->where(['url'=>$url])
            ->select(['id', 'blog_id', 'author_id', 'topic', 'views', 'date', 'content', 'url'])
            ->with('author', 'blog', 'tags')
            ->one();
    }

    public static function getBlogUrlByPageId($id)
    {
        return self::find()
            ->select(['id', 'blog_id'])
            ->where(['id'=>$id])
            ->with('blog')
            ->one();
    }

    /**
     * Получить самы популярные статьи блога/раздела/подраздела
     *
     * @param null $sectionId
     * @param int $limit
     * @return mixed
     */
    public static function getTopPages($sectionId=null, $limit=5)
    {
        $pages = (null == $sectionId)
            ? self::find()
            : self::find()->where(['id'=>$sectionId]);

        return $pages
            ->select(['id', 'blog_id', 'author_id', 'topic', 'url', 'note', 'date', 'views'])
            ->with('blog', 'author')
            ->orderBy('views DESC')
            ->limit($limit)
            ->all();
    }

    /**
     * Формирование списка статей для select-а
     *
     * @return mixed
     */
    public static function getAllPagesMap($excludeIds=[])
    {
        $menu = Yii::$app->db
            ->createcommand('SELECT [[id]], [[topic]] FROM {{pages}}')
            ->queryAll();

        $menu = ArrayHelper::map($menu, 'id', 'topic');
        if ($excludeIds) {
            $excludeIds = ArrayHelper::map($excludeIds, 'id', 'topic');
            $menu = array_diff($menu, $excludeIds);
        }
        #array_unshift($menu, '-- Выберите статью --');

        return $menu;
    }

    public static function getAllPagesUrlMap($excludeIds=[])
    {
        $urls = Yii::$app->db
            ->createcommand('SELECT [[id]], [[url]] FROM {{pages}} ORDER By [[id]]')
            ->queryAll();

        $urls = ArrayHelper::map($urls, 'id', 'url');

        #die(print_r($urls));
        return $urls;
    }

}
