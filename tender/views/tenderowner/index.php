<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TenderownerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tender owners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenderowner-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $user = new User;
    if ($user->isAdmin()):
        ?>
        <p>
            <?= Html::a('Create Tenderowner', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            /* [
              'class' => 'kartik\grid\ExpandRowColumn',
              'value' => function ($model, $key, $index, $column) {
              return GridView::ROW_COLLAPSED;
              },
              'detail' => function ($model, $key, $index, $column) {
              return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model]);
              },
              //'disabled'=>true,
              //'detailUrl' => Url::to(['/site/test-expand'])
              ], */
            [
                'value' => function ($model, $key, $index, $column) {
                    return '<div class="col-sm-2">
                <div class="img-thumbnail img-rounded text-center">
                <img src="' . Yii::$app->homeUrl . 'images/clients/' . $model->logo . '" style="padding:2px;width:100%">
                </div>
                </div>';
                },
                'format' => 'html'
            ],
            'clientname',
            'address:ntext',
            'phone:ntext',
            'email:email',
            // 'logo',
            $user->isAdmin() ?
                    ['class' => 'yii\grid\ActionColumn'] :
                    ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
                    ],
        ],
    ]);
    ?>

</div>
