<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TopRecreuitors */

$this->title = 'Update Top Recreuitors: ' . $model->company;
$this->params['breadcrumbs'][] = ['label' => 'Top Recreuitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="top-recreuitors-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
