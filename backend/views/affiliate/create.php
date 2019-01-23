<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Affiliate */

$this->title = 'Create Affiliate';
$this->params['breadcrumbs'][] = ['label' => 'Affiliates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="affiliate-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
