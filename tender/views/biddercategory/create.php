<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Biddercategory */

$this->title = 'Create Biddercategory';
$this->params['breadcrumbs'][] = ['label' => 'Biddercategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biddercategory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
