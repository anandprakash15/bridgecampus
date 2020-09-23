<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdvertiseBanner */

$this->title = 'Create Advertise Banner';
$this->params['breadcrumbs'][] = ['label' => 'Advertise Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertise-banner-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
