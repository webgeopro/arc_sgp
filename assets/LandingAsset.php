<?php
/**
 * Добавочные файлы для страницы "Лендинги"
 */

namespace app\assets;
use yii\web\AssetBundle;

class LandingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/add-landing.min.css',
        'css/queries.min.css',
    ];
    public $js = [];

    public $depends = [
        'app\assets\AppAsset', // Загружать после базового набора
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
}
