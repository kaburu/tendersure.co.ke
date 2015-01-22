<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tender */

$this->title = 'Create Tender';
$this->params['breadcrumbs'][] = ['label' => 'Tenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
