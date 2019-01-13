<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NewsArticalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News Articals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-artical-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create News Artical', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'natype',
            'type',
            'coll_univID',
            'programID',
            //'courseID',
            //'title:ntext',
            //'description:ntext',
            //'national_international',
            //'startDate',
            //'endDate',
            //'createdDate',
            //'updatedDate',
            //'status',
            //'createdBy',
            //'updatedBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
