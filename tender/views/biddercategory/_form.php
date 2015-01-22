<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Biddercategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biddercategory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uuid')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'categoryuuid')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'bidderuuid')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'creationtime')->textInput() ?>

    <?= $form->field($model, 'paid')->textInput() ?>

    <?= $form->field($model, 'pesapalpaymentuuid')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'bankpaymentuuid')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
