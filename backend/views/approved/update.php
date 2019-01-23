<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Approved */

$this->title = 'Update Approved: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Approveds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="approved-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
