<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;

class InternetMarketingController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
