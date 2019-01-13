<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsArtical */

$this->title = 'Update News Artical: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'News Articals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-artical-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
