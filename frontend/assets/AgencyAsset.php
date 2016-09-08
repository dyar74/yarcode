<?php
/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 07.09.2016
 * Time: 15:43
 */

namespace frontend\assets;


use frontend\assets\AppAsset;


class AgencyAsset extends AppAsset
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/agency.min.css',
       // 'css/font-awesome.min.css'
    ];
    public $js = [
        'js/agency.min.js',
        'js/contact_me.js',
        'js/jqBootstrapValidation.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yarcode\fa\FontAwesomeBundle'
    ];
}