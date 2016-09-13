<?php
/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 12.09.2016
 * Time: 22:17
 */

namespace frontend\widgets;
use yii\base\Widget;
use yii\helpers\Html;
use frontend\models\ContactForm;

class ContactWidget extends Widget
{
    public function run()
    {
        $model = new ContactForm();

        return $this->render('contact', [
            'model' => $model,
        ]);
    }
}