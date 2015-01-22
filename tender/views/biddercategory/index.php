<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BiddercategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Biddercategories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biddercategory-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
    <?= Html::a('Create Biddercategory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Category',
                'attribute' => 'categoryuuid',
                'value' => function ($model, $key, $index, $column) {
                    return \kartik\helpers\Html::a($model->categoryuu->categoryname, ['category/view', 'id' => $model->categoryuu->uuid]);
                },
                        'format' => 'html'
                    ],
//            'bidderuuid',
                    [
                        'header' => 'Date added',
                        'attribute' => 'creationtime',
                        'value' => function ($model, $key, $index, $column) {
                            return date('M d, Y h:i a', strtotime($model->creationtime));
                        }
                    ],
                    [
                        'attribute' => 'paid',
                        'class' => 'kartik\grid\BooleanColumn'
                    ],
                    [
                        'header' => 'Payment Status',
                        'attribute' => 'paid',
                        'value' => function ($model, $key, $index, $column) {
                            switch ($model->paid) {
                                case 0:
                                    return '<kbd>Unpaid</kbd>';
                                case 1:
                                    return '<kbd  style="background-color: #3C763D;">Payment varified</kbd>';
                                case 2:
                                    return '<kbd style="background-color: rgb(242, 41, 41);">Pending verification</kbd>';
                            }

                            return date('M d, Y h:i a', strtotime($model->creationtime));
                        },
                        'format' => 'html',
                        'width' => '170px',
                    ],
                    // 'pesapalpaymentuuid',
                    // 'bankpaymentuuid',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}'
                    ],
                    [
                        'class' => 'kartik\grid\CheckboxColumn',
                    ],
                ],
            ]);
            ?>

            <div class="kv-panel-after">
                <div class="pull-right">
                    <button type="button" class="btn btn-primary" 
                            onclick="var keys = $('#w0').yiiGridView('getSelectedRows');
                                    if (keys.length > 0) {
                                        var href = '<?= Yii::$app->homeUrl ?>/bankpayment/create/?category=' + keys;
                                location.href = href;
                            }
                            else {
                                alert('No category selected');
                                return false;
                            }">
                <i class="glyphicon glyphicon-download-alt"></i>
                Pay for Selected categories
            </button>
        </div>        
        <div class="clearfix"></div>

    </div>

</div>
