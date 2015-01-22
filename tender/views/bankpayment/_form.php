<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use app\models\Bank;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Bankpayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bankpayment-form">


    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>


    <h5>Categories</h5>
    <p style="border: 1px solid #88FF11"> 
        <?php $count = 0;
        foreach ($category as $cat): ?>
            <?= $count+=1; echo '. ' .$cat->categoryuu->categoryname ?>
            <br>
        <?php endforeach; ?>
    </p>
    
    <p style="border: 1px solid #88FF11">
        Required payment : Ksh. <?= $payment?>
    </p>
    
    <?= $form->errorSummary($model)?>
    
    <input type="hidden" name="payment" value="<?= $payment?>"/>

    <?php //= $form->field($model, 'uuid')->textInput(['maxlength' => 20]) ?>

    <?php //= $form->field($model, 'bankuuid')->textInput(['maxlength' => 20]) ?>

    <?=
    $form->field($model, 'bankuuid')->dropDownList(
            ArrayHelper::map(Bank::find()->orderBy('bankname')->asArray()->all(), 'uuid', 'bankname'), ['prompt' => 'Select bank...'])
    ?>

    <?= $form->field($model, 'receiptno')->textInput(['maxlength' => 40]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?php //= $form->field($model, 'datepaid')->textInput() ?>

    <?=
    $form->field($model, 'datepaid')->widget(kartik\date\DatePicker::className(), [
        'pluginOptions' => ['format' => 'yyyy-mm-dd']
    ])//textInput() 
    ?>

    <?php //= $form->field($model, 'creationdate')->textInput() ?>

    <?= $form->field($model, 'bankslip')->fileInput(['maxlength' => 255]) ?>


    <?php //= $form->field($model, 'bidderuuid')->textInput(['maxlength' => 20])  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Make payment' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
