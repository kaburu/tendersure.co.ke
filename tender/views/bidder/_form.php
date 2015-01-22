<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bidder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidder-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model)?>

    <?php //= $form->field($model, 'uuid')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?php //= $form->field($model, 'username')->textInput(['maxlength' => 20]) ?>

    <?php //= $form->field($model, 'password')->passwordInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'mobile')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create Bidder account' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
