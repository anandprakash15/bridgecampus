<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Frontend */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Frontends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="frontend-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'about:ntext',
            'about_status',
            'privacy:ntext',
            'privacy_status',
            'term_condition:ntext',
            'term_condition_status',
            'createdBy',
            'updatedBy',
            'created_date',
            'updated_date',
        ],
    ]) ?>

</div>
