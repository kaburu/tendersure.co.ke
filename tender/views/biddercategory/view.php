<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Biddercategory */

$this->title = $model->uuid;
$this->params['breadcrumbs'][] = ['label' => 'Biddercategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biddercategory-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->uuid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->uuid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uuid',
            'categoryuuid',
            'bidderuuid',
            'creationtime',
            'paid',
            'pesapalpaymentuuid',
            'bankpaymentuuid',
        ],
    ]) ?>

</div>
