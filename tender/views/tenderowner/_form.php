<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tenderowner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tenderowner-form">

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>

    <?= $form->errorSummary($model) ?>

    <?php //= $form->field($model, 'uuid')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'clientname')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

        <?= $form->field($model, 'logofile')->fileInput(['maxlength' => 255]) ?>

    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
