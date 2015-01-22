<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Biddercategory */

$this->title = 'Update Biddercategory: ' . ' ' . $model->uuid;
$this->params['breadcrumbs'][] = ['label' => 'Biddercategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uuid, 'url' => ['view', 'id' => $model->uuid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="biddercategory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
