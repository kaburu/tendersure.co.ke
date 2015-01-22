<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Tenderowner;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TenderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tenders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add New Tender', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'uuid',
            [
                'header' => 'Tender owner',
                'attribute' => 'tenderowneruuid',
                'value' => function ($model, $key, $index, $column) {
                    return '<img alt="'.$model->tenderowneruu->clientname.'" src="' . Yii::$app->homeUrl . 'images/clients/' . $model->tenderowneruu->logo . '" style="padding:2px;width:100%">';
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Tenderowner::find()->orderBy('clientname')->asArray()->all(), 'uuid', 'clientname'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'All tender owners'],
                'format' => 'html'
            ],
//            'contact:ntext',
            'tendername:ntext',
            [
                'attribute' => 'opendate',
                'value' => function ($model, $key, $index, $column) {
                    return date('d-m-Y', strtotime($model->opendate));
                }
            ],
            [
                'header' => 'Tender closing date',
                'attribute' => 'closedate',
                'vAlign' => 'middle',
                'value' => function ($model, $key, $index, $column) {
                    return date('d-m-Y', strtotime($model->closedate)) . ' ' . date('h:i a', strtotime($model->closetime));
                },
                'filterType' => GridView::FILTER_DATE,
//                'filter' => ArrayHelper::map(Tenderowner::find()->orderBy('clientname')->asArray()->all(), 'uuid', 'clientname'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
//                'filterInputOptions' => ['placeholder' => 'All tender owners'],
            ],
            // 'opentime',
            // 'closedate',
//            'closetime',
            // 'description:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
