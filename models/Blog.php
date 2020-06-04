<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $url
 * @property string $comment
 *
 * @property Pages[] $pages
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['url'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'url' => 'Url',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['blog_id' => 'id']);
    }

    /**
     * Для получения имени родителя, замыкаем таблицу на себя
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id'])
            ->select(['id', 'name', 'url']);
    }

    /**
     * Получение корневого меню в левой колонке (Лендинги, Маркетинг и т.д.)
     *
     * @return mixed
     */
    public static function getMenu()
    {
        return Yii::$app->db
            ->createcommand('SELECT [[name]], [[url]], [[comment]] FROM {{blog}} WHERE parent_id=0')
            ->queryAll();
    }

    /**
     * Получение корневого меню с подменю активного раздела
     *
     * @param string $sectionUrl
     * @return mixed
     */
    public static function getSubMenu($sectionUrl='', $sectionId='')
    {
        $menu = self::getMenu();

        if ($sectionUrl or $sectionId) { // Формирование подменю выбранного раздела
            if ($sectionId)
                $page = self::getPageFieldsById('id, parent_id', $sectionId);
            else
                $page = self::getPageFieldsByUrl('id, parent_id', $sectionUrl);

            $subMenu = Yii::$app->db
                ->createcommand('
                  SELECT [[name]], [[url]], [[comment]] FROM {{blog}}
                  WHERE parent_id=:pageId
                ')
                ->bindParam(':pageId', $page['id'])
                ->queryAll();//die(print_r($subMenu));
            if ((null <> $subMenu) && (null <> $menu))
                $menu[$page['id']-1]['subMenu'] = $subMenu;
        }

        return $menu;
    }

    /**
     * Формирование списка разделов + подразделов для select-а
     *
     * @return mixed
     */
    public static function getAllMenuMap()
    {
        $menu = Yii::$app->db
            ->createcommand('SELECT [[id]], [[name]] FROM {{blog}}')
            ->queryAll();

        $menu = ArrayHelper::map($menu, 'id', 'name'); // [1=>'SMM', 2=>'sytes', ...]
        array_unshift($menu, 'Корень'); // Дополняем корневым элементом 0 => Корень

        return $menu;
    }

    /**
     * Получить только имя раздела по Url
     *
     * @param $sectionUrl
     * @return mixed
     */
    public static function getPageTitle($sectionUrl)
    {
        $page = self::getPageFieldsByUrl('name', $sectionUrl);

        return $page['name'];
    }

    /**
     * Проверка существования страницы по адресу страницы
     *
     * @param $url [yandex-direkt]
     * @return boolean
     */
    public static function isPageExists($url)
    {
        return Yii::$app->db
            ->createCommand('SELECT COUNT(*) FROM {{blog}} WHERE url=:url')
            ->bindParam(':url', $url, \PDO::PARAM_STR)
            ->queryScalar();
    }

    public static function getPageByUrl($url)
    {
        $page = Yii::$app->db
            ->createCommand('SELECT * FROM {{blog}} WHERE url=:url')
            ->bindParam(':url', $url, \PDO::PARAM_STR)
            ->queryOne();
        $page['isRoot'] = self::isRoot($page['parent_id']);

        return $page;
    }

    public static function getPageIdByUrl($url)
    {
        return Yii::$app->db
            ->createCommand('SELECT id FROM {{blog}} WHERE url=:url')
            ->bindParam(':url', $url, \PDO::PARAM_STR)
            ->queryScalar();
    }

    private static function getPageFieldsByUrl($fields='*', $url)
    {
        return Yii::$app->db
            ->createCommand("SELECT {$fields} FROM {{blog}} WHERE url=:url")
            ->bindParam(':url', $url, \PDO::PARAM_STR)
            ->queryOne();
    }

    private static function getPageFieldsById($fields='*', $id)
    {
        return Yii::$app->db
            ->createCommand("SELECT {$fields} FROM {{blog}} WHERE id=:id")
            ->bindParam(':id', $id, \PDO::PARAM_INT)
            ->queryOne();
    }

    public static function getChildId($id)
    {
        return Yii::$app->db
            ->createCommand("SELECT id con FROM {{blog}} WHERE parent_id=:id")
            ->bindParam(':id', $id, \PDO::PARAM_INT)
            ->queryColumn();
    }

    private static function isRoot($parent_id)
    {
        return $parent_id
            ? false
            : true;

    }
}
