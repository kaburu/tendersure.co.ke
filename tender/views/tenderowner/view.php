<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tenderowner */

$this->title = $model->clientname;
$this->params['breadcrumbs'][] = ['label' => 'Tenderowners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenderowner-view">

    <h4><?= Html::encode($this->title) ?></h4>


    <?=
    DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> User Details for ' . $model->clientname . '</h3>',
            'type' => DetailView::TYPE_SUCCESS,
        ],
        'attributes' => [
            'clientname',
            'address:ntext',
            'phone:ntext',
            'email:email',
            [
                'attribute' => 'logo',
                'format' => 'email',
                'value' => '<img src="/tender/web/images/clients/' . $model->logo . '"'
                . ' style="padding:2px;" alt="full_logo_dark green.jpg">',
                'format' => 'html'
            ],
//            [
//                'attribute' => 'logo',
//                'displayOnly' => true,
//                'format' => 'email',
//                'value' => '<img src="/tender/web/images/clients/full_logo_dark%20green.jpg" style="padding:2px;" alt="full_logo_dark green.jpg">',
//                'format'=>'html'
//            ],
        ],
    ])
    ?>

</div>
