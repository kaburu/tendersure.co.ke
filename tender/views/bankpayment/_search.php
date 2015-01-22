<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BankpaymentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bankpayment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uuid') ?>

    <?= $form->field($model, 'bankuuid') ?>

    <?= $form->field($model, 'receiptno') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'datepaid') ?>

    <?php // echo $form->field($model, 'creationdate') ?>

    <?php // echo $form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'bidderuuid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
