<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TopRecreuitors */

$this->title = 'Create Top Recreuitors';
$this->params['breadcrumbs'][] = ['label' => 'Top Recreuitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-recreuitors-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
