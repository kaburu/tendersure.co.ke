<div>
    <div style="padding-left:50px;overflow:hidden;">
        <h3>Tender owner Details <small><?= $model->clientname ?></small></h3>
        <div class="row">
            <div class="col-sm-2">
                <div class="img-thumbnail img-rounded text-center">
                    <img src="<?= Yii::$app->homeUrl ?>images/clients/<?= $model->logo ?>" style="padding:2px;width:100%">
                </div>
            </div>
            <div class="col-sm-4">
                <table class="table table-bordered table-condensed table-hover small">
                    <tbody>
<!--                                <tr class="danger">
                            <th colspan="3" class="text-center text-danger">Buy Amount Breakup</th>
                        </tr>-->
                        <tr class="active">
                            <th>Total tenders</th>
                            <th class="text-right">#</th>
                        </tr>
                        <tr>
                            <td>Base Price</td><td class="text-right">135.00 </td>
                        </tr>
                        <tr>
                            <td>Tax @ 6%</td><td class="text-right">9.00</td>
                        </tr>
                        <tr>
                            <td>Shipping @ 4%</td><td class="text-right">6.00</td>
                        </tr>
<!--                                <tr class="warning">
                            <th></th><th>Total</th><th class="text-right">150.00</th>
                        </tr>-->
                    </tbody>
                </table>
            </div>                    
            <div class="col-sm-1">
                <br>
                <div class="btn-group-vertical btn-group-lg" role="group" aria-label="krajee-book-detail-buttons">                            
                    <button data-original-title="Email " type="button" class="btn btn-default" title="" data-toggle="tooltip"><span class="glyphicon glyphicon-envelope"></span></button>
                </div>
            </div>
        </div>
    </div>
</div>

