<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Courses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'programID',
            'specializationID',
            'name',
            'code',
            //'sortno',
            //'courselevel',
            //'createdDate',
            //'updatedDate',
            //'status',
            //'createdBy',
            //'updatedBy',
            //'full_part_time:datetime',
            //'type',
            //'description',
            //'courseType',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
