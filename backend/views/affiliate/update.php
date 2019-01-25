<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Affiliate */

$this->title = 'Update Affiliate: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Affiliates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="affiliate-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
