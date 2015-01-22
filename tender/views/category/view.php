<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->categoryname;
$this->params['breadcrumbs'][] = ['label' => $model->tenderuu->tendername, 'url' => ['tender/'.$model->tenderuuid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php
    $user = new User;
    if ($user->isAdmin()):
        ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->uuid], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->uuid], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </p>
    <?php endif; ?>

    <?=
    DetailView::widget([
        'model' => $model,
        'enableEditMode' => false,
        'attributes' => [
            'categorynumber',
            'categoryname',
            [
                'label' => 'Tender',
                'attribute' => 'tenderuuid',
                'value' => $model->tenderuu->tendername,
            ],
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Details for '
            . $model->categoryname . '</h3>',
            'type' => DetailView::TYPE_SUCCESS,
            'footer' => Html::a('Select category for bidding', ['selectbid', 'id' => $model->uuid], ['class' => 'btn btn-primary']),
        ],
    ])
    ?>

</div>
