<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bankpayment */

$this->title = 'Update Bankpayment: ' . ' ' . $model->uuid;
$this->params['breadcrumbs'][] = ['label' => 'Bankpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uuid, 'url' => ['view', 'id' => $model->uuid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bankpayment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
