<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tenderowner */

$this->title = 'Add Tender owner';
$this->params['breadcrumbs'][] = ['label' => 'Tenderowners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenderowner-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
