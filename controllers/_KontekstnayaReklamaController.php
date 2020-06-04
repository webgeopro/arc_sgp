<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;

class KontekstnayaReklamaController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
