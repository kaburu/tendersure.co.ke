<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use app\models\User;
use dosamigos\fileupload\FileUploadUI;

/* @var $this yii\web\View */
/* @var $model app\models\Tender */

$this->title = $model->uuid;
$this->params['breadcrumbs'][] = ['label' => 'Tenders', 'url' => ['/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php
    $user = new User;
    if ($user->isAdmin()):
        ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->uuid], ['class' => 'btn btn-primary']) ?>

            <?= Html::a('Add category', ['addcategory', 'id' => $model->uuid], ['class' => 'btn btn-success']) ?>            

            <?=
            Html::a('Delete', ['delete', 'id' => $model->uuid], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
            
            <?= Html::a('View Tender Bidders', ['bidders', 'id' => $model->uuid], ['class' => 'btn btn-success']) ?> 
            
            <?= Html::img(Yii::$app->homeUrl . 'images/clients/' . $model->tenderowneruu->logo, ['style' => 'float: right; height: 35px']) . "<span style = 'float: right; padding-top: 10px'>Tender by:  </span>" ?>
        </p>
    <?php endif; ?>


    <?php
    Modal::begin([
        'id' => 'modal'
    ]);

    echo "<div id='modalContent'></div>";

    Modal::end();
    ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'enableEditMode' => false,
        'attributes' => [
            [
                'attribute' => 'tendername',
                'displayOnly' => true,
            ],
            [
                'label' => 'Tender owner',
                'attribute' => 'tenderowneruu',
                'value' => $model->tenderowneruu->clientname,
                'displayOnly' => true,
            ],
            [
                'label' => 'Contact',
                'attribute' => 'contact',
                'value' => $model->contact,
                'displayOnly' => true,
            ],
//            'contact:ntext',
//            'tendername:ntext',
//            'opendate',
            [
                'attribute' => 'opendate',
//                'value' => date('d-m-Y', strtotime($model->opendate)),
                'type' => DetailView::INPUT_DATE,
                'widgetOptions' => [
                    'pluginOptions' => ['format' => 'yyyy-mm-dd']
                ],
                'format' => 'date'
            ],
            [
                'attribute' => 'opentime',
                'type' => DetailView::INPUT_TIME,
                'format' => 'time',
            ],
//            'opentime',
//            'closedate',
            [
                'attribute' => 'closedate',
//                'value' => date('d-m-Y', strtotime($model->opendate)),
                'type' => DetailView::INPUT_DATE,
                'widgetOptions' => [
                    'pluginOptions' => ['format' => 'yyyy-mm-dd']
                ],
                'format' => 'date'
            ],
            [
                'attribute' => 'closetime',
                'type' => DetailView::INPUT_TIME,
                'format' => 'time',
            ],
//            'description:ntext',
        /* [
          'attribute' => 'description',
          //                'value' => date('d-m-Y', strtotime($model->opendate)),
          'type' => DetailView::INPUT_TEXTAREA,
          'format' => 'html'
          ], */
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Tender Details for '
            . $model->tendername . '</h3>',
            'type' => DetailView::TYPE_SUCCESS,
        ],
    ])
    ?>
    <?php
    $user = new User;
    if ($user->isAdmin()):
        ?>
        <?=
        FileUploadUI::widget([
            'model' => $model,
            'attribute' => 'tenderfile',
            'url' => ['tender/uploadfile', 'id' => $model->uuid],
            'gallery' => false,
            'fieldOptions' => [
//                'accept' => 'image/*'
            ],
            'clientOptions' => [
                'maxFileSize' => 2000000
            ],
            // ... 
            'clientEvents' => [
                'fileuploaddone' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
                'fileuploadfail' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
            ],
        ]);
        ?>
    <?php endif; ?>

    <br><br>
    <div class="description">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title">Description</h4>                
            </div>
            <?php echo $model->description; ?>
        </div>
    </div>
    <br><br>
    <h4>Tender Categories</h4>
    <form method="post">
        <table id="category" class="items">
            <tr>
                <td></td>
                <th style="width: 20%;">#</th>
                <th>Category name</th>
            </tr>
            <?php
            // print_r($model->categories); 
            foreach ($model->categories as $x) {
                ?>
                <tr>
                    <td><input type="checkbox" name="<?php echo 'category_' . $x->categorynumber; ?>" value="1"></td>
                    <td><?php echo $x->categorynumber . "<br/>"; ?></td>
                    <td>
                        <a style="text-decoration: none" href="<?= Yii::$app->homeUrl . 'category/' . $x->uuid; ?>">
                            <?php echo $x->categoryname . "<br/>"; ?></a>
                    </td>
                </tr>
            <?php }
            ?>
        </table>
        <!--<button></button>-->
    </form>

    <div class="description">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title">Files</h4>                
            </div>
            <table style="width: 100%">
                <?php foreach ($model->uploadedFiles as $file): ?>
                    <tr>
                        <td style="padding-bottom: 20px; padding-top: 20px; border-bottom: 1px solid threedshadow">
                            <a class="btn btn-success" href="<?= Yii::$app->homeUrl . 'file/?id=' . $file->id ?>">
                                <i class="glyphicon glyphicon-download"></i> Download file</a>
                                <?= $file->name ?>
                        </td>                                          
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>    

</div>

<?php //$this->registerJs("$('#ajax_link_02').click(handleAjaxLink);", \yii\web\View::POS_READY);