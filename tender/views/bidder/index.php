<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bidders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <?= Html::a('Create Bidder Account', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
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
            'name',
            'address:ntext',
            'company',
            'username',
            // 'password',
            [
                'attribute' => 'mobile',
//                'filter' => 'mobile',
                'header' => 'Phone number',
                'value' => function ($dataProvider, $key, $index, $widget) {
                    $p = '';
                    foreach (json_decode($dataProvider->mobile) as $mobi) {
                        $p = $p . $mobi . '<br>';
                    }
                    return $p;
                },
                'format' => 'html',
            ],
            'email:email',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'striped' => true,
    ]);
    ?>

</div>
