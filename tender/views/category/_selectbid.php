<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Biddercategory */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Add Bidder category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['category/'.$model->categoryuuid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biddercategory-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="biddercategory-form">
        
        <div class="row" style="padding: 30px">
            Add <strong><?=$model->categoryuu->categoryname?></strong> to your category list?
        </div>

        <?php $form = ActiveForm::begin(); ?>
        
        <?= $form->errorSummary($model)?>

        <?php //= $form->field($model, 'uuid')->textInput(['maxlength' => 20]) ?>

        <?php //= $form->field($model, 'categoryuuid')->textInput(['maxlength' => 20]) ?>

        <?php //= $form->field($model, 'bidderuuid')->textInput(['maxlength' => 20]) ?>

        <?php //= $form->field($model, 'creationtime')->textInput() ?>

        <?php //= $form->field($model, 'paid')->textInput() ?>

        <?php //= $form->field($model, 'pesapalpaymentuuid')->textInput(['maxlength' => 20]) ?>

        <?php //= $form->field($model, 'bankpaymentuuid')->textInput(['maxlength' => 20]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Add ' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>