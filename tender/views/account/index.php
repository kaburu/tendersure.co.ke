<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Role;

//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

    <p>
        <?= Html::a('Create Account', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php

//    =
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'username',
//            'roleid',
//            'email:email',
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);

    use kartik\grid\GridView;

// Generate a bootstrap responsive striped table with row highlighted on hover
//    echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
////        'columns' => $gridColumns,
//        'responsive' => true,
//        'hover' => true,
//        'export' => false,
//    ]);




    $gridColumns = [
        [
            'attribute' => 'username',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '220px',
        ],
        [
            'attribute' => 'email',
            'pageSummary' => 'Total',
            'vAlign' => 'middle',
            'width' => '220px',
        ],
        [
            'attribute' => 'roleid',
            'vAlign' => 'middle',
            'value' => function ($model, $key, $index, $widget) {
                return $model->role->rolename;
            },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ['User Role' => ArrayHelper::map(Role::find()->orderBy('rolename')->asArray()->all(), 'roleid', 'rolename')],
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => 'Any role'],
                    'format' => 'raw'
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
//                    'urlCreator' => function($action, $model, $key, $index) {
//                        return '#';
//                    },
//                    'viewOptions',
//                    'updateOptions',
//                    'deleteOptions'
                ],
                ['class' => 'kartik\grid\CheckboxColumn'],];







            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns,
                'pjax' => true,
                'pjaxSettings' => [
                    'neverTimeout' => true,
                ],
                /* 'toolbar' => [
                  ['content' =>
                  Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => 'Add Book', 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.");']) . ' ' .
                  Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid'])
                  ],
                  '{export}',
                  '{toggleData}',
                  ], */
                'export' => [
                    'fontAwesome' => true
                ],
            ]);
            ?>

</div>