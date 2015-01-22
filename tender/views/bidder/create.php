<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bidder */

$this->title = 'Create Bidder Account';
$this->params['breadcrumbs'][] = ['label' => 'Bidders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidder-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
