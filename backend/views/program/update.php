<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Program */

$this->title = 'Update Program';
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="program-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
