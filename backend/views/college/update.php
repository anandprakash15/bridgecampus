<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\College */

$this->title = 'Update College';
$this->params['breadcrumbs'][] = ['label' => 'Colleges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="college-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
