<?php
/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 12.09.2016
 * Time: 20:18
 */

namespace frontend\models;
use yii;
use yii\base\Model;
use borales\extensions\phoneInput\PhoneInputValidator;

class ContactForm extends Model
{
    public $name, $email, $phone, $message;
    public function rules()
    {
        return [

            [ ['name', 'email', 'phone', 'message'], 'required'],
            [['phone'], 'string'],
            [['phone'], PhoneInputValidator::className()],
            ['email', 'email'],
        ];
    }

}