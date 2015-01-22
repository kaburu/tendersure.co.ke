<div>
    <div style="padding-left:50px;overflow:hidden;">
        <h4>Category: <small><?= $model->categoryname ?></small></h4>
        <div class="row">            
            <div class="col-sm-10">
                <table class="table table-bordered table-condensed table-hover small">
                    <tbody>
                        <tr class="active">
                            <th>Company</th>
                            <th>Contact person</th>
                            <th>Contact phone</th>
                        </tr>                        
                        <?php foreach ($model->biddercategories as $biddercat): ?>
                            <tr>
                                <td><?= $biddercat->bidderuu->company ?></td>
                                <td><?= $biddercat->bidderuu->name ?></td>
                                <td>
                                    <a href="tel:<?= $biddercat->bidderuu->mobile ?>"><?= $biddercat->bidderuu->mobile ?></a>
                                </td>
                                <!--<td><?= $biddercat->bidderuu->name ?></td>-->
                            </tr>                            
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>                    
            <div class="col-sm-1">

            </div>
        </div>
    </div>
</div>

