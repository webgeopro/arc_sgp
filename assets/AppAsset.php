<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css',
        '//fonts.googleapis.com/css?family=Roboto+Condensed:400,700&subset=latin,cyrillic',
        '//fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic',
        'css/font-awesome.min.css',// //maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css
        ////maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css,
        'css/jquery.flipcountdown.min.css', // Счетчик
        'css/site.min.css', // Базовый стиль
    ];
    public $js = [
        '//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js',
        'js/jquery.flipcountdown.min.js', // Счетчик
        'js/jquery.lettering.min.js', // Для разбивки предложений/слов для CSS-обработки
        //'js/jquery.boxloader.min.js',
        'js/jquery.waypoints.min.js', // Отслеживание скроллинга (появление элемента)
        'js/scripts.min.js', // Базовые скрипты
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
}
