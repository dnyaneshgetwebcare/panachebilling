<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
         'css/gccsite.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
 /*   public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = ['vendor/bower/admin-lte/dist/css/AdminLTE.css',
        'vendor/bower/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'vendor/bower/admin-lte/bower_components/font-awesome/css/font-awesome.min.css',
        'vendor/bower/admin-lte/bower_components/Ionicons/css/ionicons.min.css',
        //'admin-lte/dist/css/AdminLTE.min.css',
        'vendor/bower/admin-lte/dist/css/skins/_all-skins.min.css'
        ];
    public $js = ['../../vendor/bower/admin-lte/dist/js/AdminLTE/app.js',
        '../../vendor/bower/admin-lte/bower_components/jquery/dist/jquery.min.js',
        '../../vendor/bower/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js',
        '../../vendor/bower/admin-lte/bower_components/fastclick/lib/fastclick.js',
        '../../vendor/bower/admin-lte/dist/js/adminlte.min.js',
        '../../vendor/bower/admin-lte/dist/js/demo.js'
        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];*/
}
