<?php
/**
 * Работа с сокращениями url (получение/формирование)
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Shortener;

class ShortenerController extends Controller
{
    public function actionIndex($url)
    {
        $fullUrl = Shortener::getFullUrl($url); // Получить полный url по сокращенному

        return $fullUrl
            ? $this->redirect($fullUrl) // Переход на требуемую страницу
            : $this->redirect('error'); // Отображение страницы 404-Ошибка
    }

}
