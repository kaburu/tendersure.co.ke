<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = 'User '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <!--<h4><?= Html::encode($this->title) ?></h4>-->

    <p>
        <?php //= Html::a('Update', ['update', 'id' => $model->uuid], ['class' => 'btn btn-primary']) ?>
        <?php /* =
          Html::a('Delete', ['delete', 'id' => $model->uuid], [
          'class' => 'btn btn-danger',
          'data' => [
          'confirm' => 'Are you sure you want to delete this item?',
          'method' => 'post',
          ],
          ]) */
        ?>
    </p>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> User Details for '.$model->username.'</h3>' ,
            'type' => DetailView::TYPE_SUCCESS,
        ],
        'attributes' => [
            [
                'attribute' => 'username',
                'displayOnly' => true,
            ],
            [
                'attribute' => 'password',
                'type' => DetailView::INPUT_PASSWORD,
            ],
            [
                'attribute' => 'roleid',
                'label' => 'Role name',
                'displayOnly' => true,
                'value' => $model->role->rolename
            ],
            [
                'attribute' => 'email',
                'format' => 'email',
            ],
//            ['attribute' => 'publish_date', 'type' => DetailView::INPUT_DATE],
        ]
    ]);
    ?>

</div>
