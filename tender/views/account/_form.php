<?php

use yii\helpers\Html;
//use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
//use app\models\Role;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); 
    
    $form->formConfig = [
           'labelSpan' => 2,
           'deviceSize' => ActiveForm::SIZE_MEDIUM,
           'showLabels' => true,
           'showErrors' => false 
      ];
    ?>
    
    <?= $form->errorSummary($model)?>

    <?php //= $form->field($model, 'uuid')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'passwd')->passwordInput(['maxlength' => 40]) ?>
    
    <?= $form->field($model, 'confirmpasswd')->passwordInput(['maxlength' => 40]) ?>

    <?php //= $form->field($model, 'roleid')->textInput() ?>
    
    <?php //= $form->field($model, 'roleid')->dropDownList(ArrayHelper::map(Role::find()->orderBy('roleid')->asArray()->all(), 'roleid', 'rolename')) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create Account' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
