<div>
    <div style="padding-left:50px;overflow:hidden;">
        <!--<h3>Book Details <small>The Great Gatsby</small></h3>-->
        <div class="row">
            <div class="col-sm-2">
                <div class="img-thumbnail img-rounded text-center">
                    <!--<img src="<?= Yii::$app->homeUrl ?>images/clients/<?php //=$model->biddercategories      ?>" style="padding:2px;width:100%">-->
                    <!--<span class="small text-muted">Published: 2000-10-01</span>-->
                </div>
            </div>
            <div class="col-sm-4">
                <table class="table table-bordered table-condensed table-hover small">
                    <tbody>
                        <tr class="danger">
                            <th colspan="3" class="text-center text-danger">Amount Breakup</th>
                        </tr>
                        <tr class="active">
                            <th class="text-center">#</th>
                            <th>Category </th>
                            <th class="text-right">Amount</th>
                        </tr>
                        <?php
                        $count = 0;
                        foreach ($model->biddercategories as $biddercat):
                            ?>
                            <tr>
                                <td class="text-center"><?= $count+=1 ?></td>
                                <td><?= $biddercat->categoryuu->categoryname ?></td><td class="text-right">2000.00 </td>
                            </tr>
                        <?php endforeach; ?>                        
                    </tbody>
                </table>
            </div>            
        </div>
    </div>
</div>

