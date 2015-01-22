<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TenderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tender-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uuid') ?>

    <?= $form->field($model, 'tenderowneruuid') ?>

    <?= $form->field($model, 'contact') ?>

    <?= $form->field($model, 'tendername') ?>

    <?= $form->field($model, 'opendate') ?>

    <?php // echo $form->field($model, 'opentime') ?>

    <?php // echo $form->field($model, 'closedate') ?>

    <?php // echo $form->field($model, 'closetime') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
