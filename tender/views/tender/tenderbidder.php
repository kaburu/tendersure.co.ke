<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
    <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model]);
                },
                        'collapseIcon' => '<span class="glyphicon glyphicon-minus-sign"></span>',
                        'expandIcon' => '<span class="glyphicon glyphicon-plus-sign"></span>',
                        'expandTitle' => 'Expand to view details'
                    ],
                    'categorynumber',
                    'categoryname',
                    [
                        'header' => 'Registered Bidders',
                        'width' => '10px',
                        'value' => function ($model, $key, $index, $column) {
                            return count($model->biddercategories);
                        }
                    ],
                ],
            ]);
            ?>

</div>
