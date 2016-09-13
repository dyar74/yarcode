<?php
/**
 * Created by PhpStorm.
 * User: Yar
 * Date: 12.09.2016
 * Time: 22:16
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\Url;
use yii\widgets\Pjax;
use borales\extensions\phoneInput\PhoneInput;
?>
<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Contact Us</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php Pjax::begin() ?>
                <?php
                $form = ActiveForm::begin([
                    'id' => 'contact-form',
                    'method' => 'post',
                    'action' => Url::to(['/site/send-email']),
                    'enableAjaxValidation' => true,
                    'validationUrl' => Url::to(['/site/validate']),
                    'options' => [
                        'data-pjax' => true,
                    ],
                ]);
                ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'name')->textInput(['placeholder' => Yii::t('app', 'Your Name')])->label(false) ?>
                            <?= $form->field($model, 'email')->textInput(['placeholder' =>  Yii::t('app', 'Your Email')])->label(false) ?>
                            <?= $form->field($model, 'phone')->widget(PhoneInput::className(), [
                                'jsOptions' => [
                                    'preferredCountries' => ['en', 'ru', 'ua'],
                                    'autoHideDialCode' => false,
                                    'nationalMode' => false,
                                ]
                            ])->label(false); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'message')->textArea(['rows' => '6', 'placeholder' =>  Yii::t('app', 'Your Message')])->label(false); ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success"></div>
                            <?= Html::submitButton( Yii::t('app', 'Send Message'), ['class' =>  'btn btn-xl']) ?>
                        </div>
                    </div>



                <?php ActiveForm::end(); ?>

                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</section>
