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
use common\models\Portfolio;

class PortfoliosWidget extends Widget
{
    public $view;
    public function run()
    {
        $portfolios = Portfolio::getPortfolios();

        return $this->render($this->view, [
            'portfolios' => !empty($portfolios) ? $portfolios : null,
        ]);
    }
}