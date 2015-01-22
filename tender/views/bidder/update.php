<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bidder */

$this->title = 'Update Bidder: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bidders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->uuid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
