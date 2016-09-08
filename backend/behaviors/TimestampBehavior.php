<?php

/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 08.09.2016
 * Time: 13:05
 */
namespace backend\behaviors;

use yii\db\Expression;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    public $createdAtAttribute = 'created_at';
    public $updatedAtAttribute = 'updated_at';

    public function init()
    {
        parent::init();

        if (empty($this->value)) {
            $this->value = new Expression('NOW()');
        }
    }
}