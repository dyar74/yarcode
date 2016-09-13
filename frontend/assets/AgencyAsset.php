<?php
/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 07.09.2016
 * Time: 15:43
 */

namespace frontend\assets;


use frontend\assets\AppAsset;
use yii\jui\JuiAsset;


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

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yarcode\fa\FontAwesomeBundle'
    ];
}