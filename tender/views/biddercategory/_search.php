<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BiddercategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biddercategory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uuid') ?>

    <?= $form->field($model, 'categoryuuid') ?>

    <?= $form->field($model, 'bidderuuid') ?>

    <?= $form->field($model, 'creationtime') ?>

    <?= $form->field($model, 'paid') ?>

    <?php // echo $form->field($model, 'pesapalpaymentuuid') ?>

    <?php // echo $form->field($model, 'bankpaymentuuid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
