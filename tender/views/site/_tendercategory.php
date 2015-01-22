<?php

use yii\helpers\Html;

$amt = count($list) * $cost;
if (count($out) > 0):
    ?>
    <div class="form-group">Cost per category: <strong>Ksh <span id="category-cost"><?= $cost ?></span></strong></div>
    <div class="form-group">Total cost: <strong>Ksh <span id="expected-payment"><?= $amt ?></span></strong></div>
    <fieldset>
        <h4>Select tender categories <span class="danger">*</span>
            <span id="selected" style="float: right">(<?= count($list) ?> categories selected)</span></h4>

        <?php
        echo Html::checkboxList('RegistrationForm[tendercategory]', $list, $out, ['itemOptions' =>
            ['onchange' => "updatepayment();"]]);
        ?>
    </fieldset>

    <?php


 endif;