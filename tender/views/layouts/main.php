<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <link rel="shortcut icon" href="../fav.jpg">
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode('Bidder Registration :: Tendersure') ?></title>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <div class="wrap">

            <?php if (!Yii::$app->user->isGuest): ?>
                <?php
                NavBar::begin([
                    'brandLabel' => 'Tendersure',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Tenders', 'url' => ['/site/index']],
//                    ['label' => 'About', 'url' => ['/site/about']],
                        ['label' => 'Contact', 'url' => ['/site/contact']],
                        Yii::$app->user->isGuest ?
                                '' :
                                ['label' => 'Bidders',
                            'url' => ['/biddercategory'],
                            'linkOptions' => ['data-method' => 'post']],
                        Yii::$app->user->isGuest ?
                                '' :
                                ['label' => 'Payments',
                            'url' => ['/bankpayment'],
                            'linkOptions' => ['data-method' => 'post']],
                        Yii::$app->user->isGuest ?
                                '' :
                                ['label' => 'Account',
                            'url' => ['/bidder/view', 'id' => Yii::$app->user->getId()],
                            'linkOptions' => ['data-method' => 'post']],
                        Yii::$app->user->isGuest ?
                                ['label' => 'Login', 'url' => ['/site/login']] :
                                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    ],
                ]);
                NavBar::end();

            else :
                ?>
                <div class="container-fluid" style="padding: 0; background-color: #d4d4d4;">
                    <div class="container">
                        <div class="banner centered-banner" style="background-color:#d4d4d4">
                            <div class="fixed-width cf">
                                <h1 class="banner-logo" style="text-align: center; margin: 0">
                                    <a href="<?= Yii::$app->homeUrl ?>" title="Tendersure" rel="home">
                                        <img src="<?= Yii::$app->homeUrl ?>images/header.png" alt="Tendersure" style="width: 90%; padding-top: 0"></a>
                                </h1>			
                            </div>
                        </div>  
                    </div>

                    <div style="background:#f0f0f0;" class="row one-column cf ui-sortable" id="le_body_row_1" data-style="eyJiYWNrZ3JvdW5kQ29sb3JTdGFydCI6IiNmMGYwZjAifQ==">
                        <div class="fixed-width">
                            <div class="one-column column cols" id="le_body_row_1_col_1">
                                <div class="element-container cf" data-style="" id="le_body_row_1_col_1_el_1">
                                    <div class="element container" style="width: 900px; text-align: center"> 
                                        <h2 style="font-size:36px;font-family:Impact, Charcoal, sans-serif;font-style:normal;font-weight:300;color:#033388;text-align:center;">
                                            “the next generation of e-procurement”</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif;
            ?>


            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">Copyright &copy; <?= date('Y') ?> Tendersure. All Rights Reserved</p>

            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
