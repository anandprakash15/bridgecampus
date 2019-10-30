<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/mdb.min.css',
        'css/site.css',
        'css/fontawesome.min.css',
        'css/regular.min.css',
        'css/solid.min.css',
        'css/mmenu.css',
    ];
    public $js = [
        'js/mdb.min.js',
        'js/mmenu.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
