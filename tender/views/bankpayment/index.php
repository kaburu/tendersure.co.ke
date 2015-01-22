<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BankpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bankpayments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bankpayment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a('Create Bankpayment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'class' => 'kartik\grid\ExpandRowColumn',
              'value' => function ($model, $key, $index, $column) {
              return GridView::ROW_COLLAPSED;
              },
              'detail' => function ($model, $key, $index, $column) {
              return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model]);
              },
              //'disabled'=>true,
              //'detailUrl' => Url::to(['/site/test-expand'])
              ],

//            'uuid',
            'bankuu.bankname',
            'receiptno',
            'amount',
            'datepaid',
            // 'creationdate',
            // 'filename',
            // 'bidderuuid',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
