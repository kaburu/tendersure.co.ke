<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use app\models\Tenderowner;
use app\models\Tendertype;
use dosamigos\ckeditor\CKEditor;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tender */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tender-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?=$form->errorSummary($model)?>

    <?php //= $form->field($model, 'uuid')->textInput(['maxlength' => 20]) ?>

    <?=
    $form->field($model, 'tenderowneruuid')->dropDownList(
            ArrayHelper::map(Tenderowner::find()->orderBy('clientname')->asArray()->all(), 'uuid', 'clientname'), ['prompt' => 'Select...'])
    ?>

    <?= $form->field($model, 'tendername')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'tendertypeid')->dropDownList(
            ArrayHelper::map(Tendertype::find()->orderBy('tendertypeid')->asArray()->all(), 
                    'tendertypeid', 'tendertype'), ['prompt' => 'Select a tender type'])//textInput() ?> 

    <?=
    $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic',
    ])//textarea(['rows' => 6]) 
    ?>

    <?php //= $form->field($model, 'tenderowneruuid')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'contact')->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'opendate')->widget(kartik\date\DatePicker::className(), [
        'pluginOptions' => ['format' => 'yyyy-mm-dd']
    ])//textInput() 
    ?>

    <?= $form->field($model, 'opentime')->widget(kartik\time\TimePicker::className())//textInput() ?>

    <?=
    $form->field($model, 'closedate')->widget(kartik\date\DatePicker::className(), [
        'pluginOptions' => ['format' => 'yyyy-mm-dd']
    ])//textInput() 
    ?>

    <?= $form->field($model, 'closetime')->widget(kartik\time\TimePicker::className())//textInput()  ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
