<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "authors".
 *
 * @property string $id
 * @property string $fname
 * @property string $lname
 * @property string $nick
 * @property string $avatar
 * @property string $ratings
 * @property string $comment
 *
 * @property Pages[] $pages
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ratings'], 'integer'],
            [['fname'], 'string', 'max' => 30],
            [['lname', 'avatar'], 'string', 'max' => 50],
            [['nick'], 'string', 'max' => 15],
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
            'fname' => 'Fname',
            'lname' => 'Lname',
            'nick' => 'Nick',
            'avatar' => 'Avatar',
            'ratings' => 'Ratings',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['author_id' => 'id']);
    }


    /**
     * Формирование списка разделов + подразделов для select-а
     *
     * @return mixed
     */
    public static function getAllAuthorsMap()
    {
        $menu = Yii::$app->db
            ->createcommand('SELECT [[id]], CONCAT([[fname]], " ", [[lname]]) name FROM {{authors}}')
            ->queryAll();

        return ArrayHelper::map($menu, 'id', 'name');
    }
}
