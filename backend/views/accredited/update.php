<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Accredited */

$this->title = 'Update Accredited: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Accrediteds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accredited-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
