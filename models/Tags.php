<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tags".
 *
 * @property string $id
 * @property string $name
 * @property string $page_id
 * @property string $url
 *
 * @property Pages $page
 * @property TagsPages[] $tagsPages
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id'], 'integer'],
            [['name'], 'string', 'max' => 15],
            [['url'], 'string', 'max' => 100],
            [['url'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'page_id' => 'Page ID',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsPages()
    {
        return $this->hasMany(TagsPages::className(), ['tag_id' => 'id']);
    }

    /**
     * Получить страницы связанные с текущим тегом
     * Связь many-to-many через таблицу tags_pages
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['id' => 'page_id'])
            ->viaTable('tags_pages', ['tag_id' => 'id'])
            ->select(['id']);
    }

    /**
     * Проверка существования тега
     *
     * @param $tag
     * @return boolean
     */
    public static function isTagExists($tag)
    {
        return Yii::$app->db
            ->createcommand('SELECT COUNT(*) FROM {{tags}} WHERE url=:tag')
            ->bindParam(':tag', $tag, \PDO::PARAM_STR)
            ->queryScalar();
    }

    public static function getMaxTagsCount()
    {
        return Yii::$app->db
            ->createcommand('SELECT COUNT(*) cnt FROM tags_pages GROUP BY tag_id ORDER BY cnt DESC LIMIT 1')
            ->queryScalar();
    }

    /**
     * Получить ID всех страниц, связанных с текущим тегом
     *
     * @param string $tagUrl
     * @return \yii\db\ActiveRecord / string
     */
    public static function getPagesIdsByTag($tagUrl)
    {
        if (Tags::isTagExists($tagUrl)) {

            $ids =  self::find()
                ->select(['id', 'url'])
                ->where(['url' => $tagUrl])
                ->with('pages')
                ->asArray()
                ->all();
            if (null != $ids) { // Получается весьма копявая структура [0=>[pages=>[id]]]
                foreach ($ids[0]['pages'] as $id) {
                    $tmp[] = $id['id'];
                }

                return (empty($tmp)) ? null : $tmp;
            }
        }

        return null;
    }

    /**
     * Получить все используемые в блоге теги, которые с чем-нибудь ассоциированы
     *
     * @param bool $withCount
     * @return mixed
     */
    public static function getAllTags($withCount=false)
    {
        $query = $withCount

            ? 'SELECT tags.url url, tags.name name, COUNT(*) cnt
               FROM tags
                 LEFT JOIN tags_pages
                   ON tags_pages.tag_id = tags.id
               GROUP BY tags.url'

            : 'SELECT DISTINCT url, name FROM {{tags}}';

        return Yii::$app->db
            ->createcommand($query)
            ->queryAll();

        /*SELECT tags.url url, tags.name `name`, COUNT(*) cnt FROM tags
        LEFT JOIN tags_pages ON tags_pages.tag_id = tags.id
        GROUP BY tags_pages.page_id;*/
    }

    /**
     * Формирование списка тегов для select-а
     *
     * @return mixed
     */
    public static function getAllTagsMap($excludeIds=[])
    {#die(print_r($excludeIds));
        $menu = Yii::$app->db
            ->createcommand('SELECT [[id]], [[name]] FROM {{tags}}')
            ->queryAll();

        $menu = ArrayHelper::map($menu, 'id', 'name');
        //array_unshift($menu, 'Корень'); // Дополняем корневым элементом 0 => Корень
        if ($excludeIds) {
            $excludeIds = ArrayHelper::map($excludeIds, 'id', 'name');
            $menu = array_diff($menu, $excludeIds);
        }

        return $menu;
    }
}
