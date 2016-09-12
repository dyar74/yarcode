<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Portfolio */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Portfolio',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Portfolios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="portfolio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
