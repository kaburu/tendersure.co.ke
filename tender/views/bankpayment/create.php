<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bankpayment */

$this->title = 'Add Bank payment';
$this->params['breadcrumbs'][] = ['label' => 'Bankpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bankpayment-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
         'payment' => $payment,
    ]) ?>

</div>
