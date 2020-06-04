<?php
/**
 * User: Vah
 * Date: 19.10.2015
 */
namespace app\components;

use yii\base\Widget;
use app\models\Pages;

class TopWidget extends Widget {

    public $activeUrl;

    public function run()
    {
        $articles = Pages::getTopPages($this->activeUrl);

        return $this->render('top', [
                'articles' => $articles,
            ]);
    }
} 