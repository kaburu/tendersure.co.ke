<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">   
    <div class="result_bar" style="padding:5px 10px">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody><tr>
                    <td>
                        Currently open tenders
                    </td>                    
                </tr>
            </tbody>
        </table>
    </div>
    <?php
     echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
    <table>
        <?php foreach ($models as $model) { ?>

        <tr>
                <td valign="top" width="778" style="padding-top: 20px">
                    <div class="text_largelbl"><a href="<?= Yii::$app->homeUrl . 'tender/' . $model->uuid ?>"><?= $model->tendername ?></a></div>
                    <div class="text_mid"><strong>Type : </strong>
                        <?= $model->tendertypeid == null ? 'Tender ( IFB )' : $model->tendertype->tendertype ?>
                    </div>
                    <!--<div class="text_mid"><strong>Ref No. </strong>KIM/001/2015-2016</div>-->
                    <div class="text_mid"><strong>By : </strong><?= $model->tenderowneruu->clientname ?></div>
                    <div class="text_mid">
                        <strong>Closing On : </strong><?= date('D, M d, Y', strtotime($model->closedate)) ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php
// display pagination
    echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
</div>
