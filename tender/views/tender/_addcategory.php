<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Add category';
$this->params['breadcrumbs'][] = ['label' => 'Tenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="category-form">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'tendercategory',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
        ]);
        ?>   

        <?= $form->errorSummary($model) ?>

        <?php //= $form->field($model, 'uuid')->textInput(['maxlength' => 20]) ?>

        <?= $form->field($model, 'categorynumber')->textInput() ?>

        <?= $form->field($model, 'categoryname')->textarea() ?>

        <?php //= $form->field($model, 'tenderuuid')->hiddenInput(['maxlength' => 20])  ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>    

        <?php ActiveForm::end(); ?>
    </div>

</div>


