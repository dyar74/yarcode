<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\switchinput\SwitchInput;
use \yii\helpers\Url;
use yii\jui\DatePicker;
use \yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Portfolio */
/* @var $form yii\widgets\ActiveForm */

$css = <<<CSS
.ui-datepicker-calendar {
    display: none;
    }
CSS;
$this->registerCss($css);
?>

<div class="portfolio-form">

    <?php
        $form = ActiveForm::begin([
            'enableClientValidation' => false,
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
        ]);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
    'options' => ['rows' => 8],
    'preset' => 'full',
    'clientOptions' => [
    'filebrowserUploadUrl' => '/portfolio/upload'
    ]
    ])
    ?>
    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => Yii::$app->language,
        'dateFormat' => 'yyyy/MM/dd',
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
            'showButtonPanel' => true,

            'onClose' => new JsExpression("function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }"),
        ],


    ]) ?>


    <?= $form->field($model, 'client')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'display_order')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?=
    $form->field($model, 'status')->widget(SwitchInput::classname(), [
        'type' => SwitchInput::CHECKBOX
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
