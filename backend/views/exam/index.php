<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Exam', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'examcatID',
            'courseID',
            'name:ntext',
            'exam_dates:ntext',
            //'exam_fullname:ntext',
            //'conductedBy:ntext',
            //'process:ntext',
            //'highlight:ntext',
            //'eligibility:ntext',
            //'appform:ntext',
            //'exam_center:ntext',
            //'r_book',
            //'result:ntext',
            //'cutt_off:ntext',
            //'selection_process:ntext',
            //'main_stream:ntext',
            //'summary:ntext',
            //'analysis:ntext',
            //'bylocation:ntext',
            //'question_paper:ntext',
            //'ans_key:ntext',
            //'counselling',
            //'syllabus:ntext',
            //'admit_card:ntext',
            //'upload_guide:ntext',
            //'createdDate',
            //'updatedDate',
            //'status',
            //'createdBy',
            //'updatedBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
