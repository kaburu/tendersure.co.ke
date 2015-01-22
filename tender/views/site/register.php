<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Register';
?>
<style>
    .danger {
        color: red;
    }
    #registration-form{
        padding-bottom: 15px;
        padding-top: 15px;
        background-repeat: repeat-x;
        background-position: inherit;
        background-image: url("<?= Yii::$app->homeUrl ?>images/body.png");
        color: inherit;
    }
    .hr-style-6 {
        border-top: 1px dashed #cacaca;
        display: block;
        margin: 20px 0 30px;
        position: relative;
        text-align: right;
    }
    .arrow-center {
        text-align: center;
    }
    #tendercat label{
        display: block;
        border-bottom: 1px solid #ccc;
    }
    #tendercat fieldset div {
        background-color:white;
        max-height: 250px;

    }
</style>

<div class="site-about">    

    <div class = "col-md-8">
        <div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_1">
            <div class="element"> 
                <div class="op-text-block" style="width:620px;text-align: left;">
                    <p style="font-size:14px;">Dear Prospective Service Provider.</p>
                    <p style="font-size:14px;">We thank you for your interest in participating in the Tender Process through Tendersure</p>
                </div>
            </div>
        </div>
        <div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_2">
            <div class="element"> 
                <div class="styled-hr hr-style-6">
                    <hr>
                </div>
            </div>
        </div>

        <div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_3">
            <div class="element"> 
                <h2 style="font-size:30px;font-family:Tahoma, Geneva, Verdana, sans-serif;
                    font-weight:bold;color:#980b0b;text-align:center;">Register Below:
                </h2>
            </div>
        </div>

        <div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_4">
            <div class="element"> 
                <div class="arrow-center">
                    <img src="<?= Yii::$app->homeUrl ?>images/arrow-silver-1.png" class="arrows">
                </div>
            </div>
        </div>
        <?= Yii::$app->session->getFlash('formSubmitted') ?>
        <?php
        $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    'options' => ['enctype' => 'multipart/form-data']]);

        $form->formConfig = [
            'labelSpan' => 2,
            'deviceSize' => ActiveForm::SIZE_MEDIUM,
            'showLabels' => true,
            'showErrors' => false
        ];
        ?>

        <?= $form->errorSummary($model) ?>

        <?= $form->field($model, 'companyname', ['parts' => ['{label}' => $model->attributeLabels()['companyname'] . "<span class='danger'> *</span>"]])->textInput() ?>

        <?= $form->field($model, 'contactperson', ['parts' => ['{label}' => $model->attributeLabels()['contactperson'] . "<span class='danger'> *</span>"]])->textInput() ?>

        <?= $form->field($model, 'email', ['parts' => ['{label}' => $model->attributeLabels()['email'] . "<span class='danger'> *</span>"]])->textInput() ?>

        <?= $form->field($model, 'phone', ['parts' => ['{label}' => $model->attributeLabels()['phone'] . "<span class='danger'> *</span>"]])->textInput() ?>

        <?= $form->field($model, 'comment')->textArea(['rows' => 6]) ?>

        <?=
        $form->field($model, 'tenderowner', ['parts' => ['{label}' => $model->attributeLabels()['tenderowner']
                . "<span class='danger'> *</span>"]])->dropDownList($catList, ['id' => 'tenderowner', 'prompt' => 'Select a tender']);
        ?>

        <input type="hidden" value="<?= count($list) * $cost?>" id="amthid" name="RegistrationForm[amthid]"/>        

        <div id="tendercat">
            <?php
            if (isset($model->tenderowner)):
                echo $this->render('_tendercategory', ['out' => $tc, 'list' => $list, 'cost' => $cost]);
            else :
                echo $form->field($model, 'tendercategory', ['parts' => ['{label}' => '']])->checkboxList([]);
            endif;
            ?>
        </div>

        <?php if ($cost > 0): ?>
            <div id="radiopayment" class="form-group">
            <?php else : ?>
                <div id="radiopayment" class="form-group" style="display: none">
                <?php endif;
                ?>

                <?= $form->field($model, 'paymentapplicable')->dropDownList(['1' => 'Bank payment', '2' => 'Online payment'], ['prompt' => 'Select mode of payment']); ?>
            </div>

            <?php if ($model->paymentapplicable === '1'): ?>
                <div id="payment">
                <?php else : ?>
                    <div id="payment" style="display: none">
                    <?php endif;
                    ?>

                    <fieldset>
                        <legend>Payment details</legend>
                        <?= $form->field($model, 'amount', ['parts' => ['{label}' => $model->attributeLabels()['amount'] . "<span class='danger'> *</span>"]])->textInput() ?>

                        <?= $form->field($model, 'receipt')->textInput() ?>

                        <?= $form->field($model, 'file', ['parts' => ['{label}' => $model->attributeLabels()['file'] . "<span class='danger'> *</span>"]])->fileInput() ?>
                    </fieldset>
                </div>


                <div class="form-group">
                    <?= Html::submitButton('Click to Register', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <div class="col-md-4">

                <div class="element-container cf" data-style="" id="le_body_row_2_col_2_el_6">
                    <div class="element"> 
                        <div class="image-caption" style="width:170px;margin-top:0px;margin-bottom:0px;margin-right:auto;margin-left:0;">
                            <img alt="" src="<?= Yii::$app->homeUrl ?>images/clients/<?= $logo ?>" border="0" class="full-width">
                        </div>
                    </div>
                </div>

                <div class="clear"  style="margin-bottom: 40px"></div>

                <h2 style="font-size:18px;text-align:left;">Some of our Clientele include:</h2>


                <?php foreach ($clients as $client): ?>
                    <ul class="clients" style="list-style: none">
                        <li style="background-position: 0 4px;padding-left: 24px;font-family: 'Raleway', sans-serif;
                            color: #6e737c;background-image:url('<?= Yii::$app->homeUrl ?>images/18.png');
                            background-repeat:no-repeat;font-size:13px;"><?= $client ?></li>
                    </ul>
                <?php endforeach; ?>
                <ul class="clients" style="list-style: none">
                    <li style="background-position: 0 4px;padding-left: 24px;font-family: 'Raleway', sans-serif;
                        color: #6e737c;background-image:url('<?= Yii::$app->homeUrl ?>images/18.png');
                        background-repeat:no-repeat;font-size:13px;">and more each day…</li>
                </ul>

                <div class="clear"  style="margin-bottom: 20px"></div>

                <iframe width="300" height="200" src="//www.youtube.com/embed/rJG7KaDrBO8" frameborder="0" allowfullscreen></iframe>

                <div class="clear"  style="margin-bottom: 20px"></div>

                <div class="element-container cf" data-style="" id="le_body_row_2_col_2_el_6">
                    <div class="element"> 
                        <div class="image-caption" style="width:170px;margin-top:0px;margin-bottom:0px;margin-right:auto;margin-left:auto;">
                            <img alt="" src="<?= Yii::$app->homeUrl ?>images/i1.jpg" border="0" class="full-width">
                        </div>
                    </div>
                </div>

                <div class="clear" style="margin-bottom: 20px"></div>

                <div class="element-container cf" data-style="" id="le_body_row_2_col_2_el_6">
                    <div class="element"> 
                        <div class="image-caption" style="width:170px;margin-top:0px;margin-bottom:0px;margin-right:auto;margin-left:auto;">
                            <img alt="" src="<?= Yii::$app->homeUrl ?>images/i2.png" border="0" class="full-width" style="width: 130%">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            amount = document.getElementById("registrationform-amount");
            amthid = document.getElementById("amthid");
            pay = document.getElementById("registrationform-tenderpayment");


            ten = document.getElementById('tendercat');

            tenderowner = document.getElementById("tenderowner");

            function updatepayment() {
                var exppay = document.getElementById("expected-payment");
                var count = document.querySelectorAll('input[type=\"checkbox\"]:checked').length;
                var catcost = document.getElementById('category-cost').innerHTML;
                exppay.innerHTML = count * catcost;
                amthid.value = exppay.innerHTML;
                document.getElementById('selected').innerHTML = "(" + count + " categories selected)";

                if (exppay.innerHTML > 0) {
                    document.getElementById("registrationform-paymentapplicable").required = true;
                    document.getElementById("radiopayment").style.display = "block";
                } else {
                    document.getElementById("registrationform-paymentapplicable").required = false;
                    document.getElementById("registrationform-paymentapplicable").selectedIndex = 0;
                    document.getElementById("registrationform-amount").required = false;
                    document.getElementById("registrationform-file").required = false;
                    document.getElementById("radiopayment").style.display = "none";
                    document.getElementById("payment").style.display = "none";
                }
            }


            tenderowner.onchange = function () {
                $.post(
                        "<?= Yii::$app->homeUrl ?>category",
                        {tender: $("#tenderowner").val()},
                function (data) {
                    $('#tendercat').html(data);
                }

                );
            };

            amount.onblur = function () {
                var exppay = document.getElementById("expected-payment");
                if (exppay.innerHTML !== amount.value) {
                    alert("Amount must be equal to total cost for selected categories");
                }
            };

            paymode = document.getElementById("registrationform-paymentapplicable");
            paymode.onchange = function () {
                if (this.value === '1') {
                    document.getElementById("registrationform-amount").required = true;
                    //            document.getElementById("registrationform-file").required = true;
                    document.getElementById("payment").style.display = "block";
                } else if (this.value === '2') {
                    document.getElementById("registrationform-amount").required = false;
                    document.getElementById("registrationform-file").required = false;
                    document.getElementById("payment").style.display = "none";
                }
            };



            function showPayment() {
                var chbox = document.getElementById("registrationform-paymentapplicable");


                if (chbox.checked)
                {
                    document.getElementById("registrationform-amount").required = true;
                    document.getElementById("registrationform-file").required = true;
                    document.getElementById("payment").style.display = "block";
                    //            alert(document.getElementById("registrationform-tenderpayment").key);
                } else {
                    document.getElementById("registrationform-amount").required = false;
                    document.getElementById("registrationform-file").required = false;
                    document.getElementById("payment").style.display = "none";

                }
            }
        </script>
