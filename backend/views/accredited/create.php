<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Accredited */

$this->title = 'Create Accredited';
$this->params['breadcrumbs'][] = ['label' => 'Accrediteds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accredited-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
