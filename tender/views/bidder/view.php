<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bidder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bidders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidder-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->uuid], ['class' => 'btn btn-primary']) ?>
        <?php //= Html::a('Delete', ['delete', 'id' => $model->uuid], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'uuid',
            'name',
            'address:ntext',
            'company',
//            'username',
//            'password',
            'mobile:ntext',
            'email:email',
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Details for '
            . $model->name . '</h3>',
            'type' => DetailView::TYPE_SUCCESS,
        ],
    ]) ?>

</div>
