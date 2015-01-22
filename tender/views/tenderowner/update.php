<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tenderowner */

$this->title = 'Update Tenderowner: ' . ' ' . $model->clientname;
$this->params['breadcrumbs'][] = ['label' => 'Tenderowners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uuid, 'url' => ['view', 'id' => $model->uuid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tenderowner-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
