<?php

namespace app\models;

use Yii;


/**
 * Модель для работы с сокращениями url-адресов
 *
 * @property string $id
 * @property string $short
 * @property string $full
 * @property integer $page_id
 */
class Shortener extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shortener';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id'], 'required'],
            [['page_id'], 'integer'],
            [['short'], 'string', 'max' => 3],
            [['full'], 'string', 'max' => 100],
            [['short'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'short' => 'Short Url',
            'full'  => 'Full Url',
            'page_id' => 'Page ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'page_id'])
            ->select(['id', 'topic', 'url']);
    }

    /**
     * Проверка существования страницы по короткому url-у
     *
     * @param $url [Short Url (u3g)]
     * @return boolean
     */
    public static function isPageExists($url)
    {
        return Yii::$app->db
            ->createCommand('SELECT COUNT(*) FROM {{shortener}} WHERE short=:url')
            ->bindParam(':url', $url, \PDO::PARAM_STR)
            ->queryScalar();
    }

    /**
     * Получить полный адрес страницы по сокращенному url-у
     *
     * @param $url
     * @return string
     */
    public static function getFullUrl($url)
    {
        return Yii::$app->db
            ->createCommand('SELECT full AS url FROM {{shortener}} WHERE short=:url')
            ->bindParam(':url', $url, \PDO::PARAM_STR)
            ->queryScalar();
    }

    /**
     * Получить полный адрес страницы из модели Pages по сокращенному url-у
     *
     * @param $shortUrl
     * @return string
     */
    public static function getPageUrl($shortUrl)
    {
        return Yii::$app->db
            ->createCommand('
              SELECT pages.url url FROM {{shortener}} shortener WHERE shortener.short=:url
              LEFT JOIN {{pages}} pages
                ON shortener.page_id == pages.id
              ')
            ->bindParam(':url', $shortUrl, \PDO::PARAM_STR)
            ->queryScalar();
    }

    /**
     * Получить ID страницы по сокращенному url-у
     *
     * @param $url
     * @return int
     */
    public static function getPageIdByShortUrl($url)
    {
        return Yii::$app->db
            ->createCommand('SELECT page_id AS id FROM {{shortener}} WHERE short=:url')
            ->bindParam(':url', $url, \PDO::PARAM_STR)
            ->queryScalar();
    }

}
