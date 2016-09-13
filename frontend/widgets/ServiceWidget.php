<?php

/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 12.09.2016
 * Time: 10:47
 */
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use common\models\Service;

class ServiceWidget extends Widget
{
    public function run()
    {
        $services = Service::getServices();

        return $this->render('services', [
            'services' => !empty($services) ? $services : null,
        ]);
    }
}