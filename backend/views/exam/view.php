<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-view">

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
            'examcatID',
            'courseID',
            'name:ntext',
            'exam_dates:ntext',
            'exam_fullname:ntext',
            'conductedBy:ntext',
            'process:ntext',
            'highlight:ntext',
            'eligibility:ntext',
            'appform:ntext',
            'exam_center:ntext',
            'r_book',
            'result:ntext',
            'cutt_off:ntext',
            'selection_process:ntext',
            'main_stream:ntext',
            'summary:ntext',
            'analysis:ntext',
            'bylocation:ntext',
            'question_paper:ntext',
            'ans_key:ntext',
            'counselling',
            'syllabus:ntext',
            'admit_card:ntext',
            'upload_guide:ntext',
            'createdDate',
            'updatedDate',
            'status',
            'createdBy',
            'updatedBy',
        ],
    ]) ?>

</div>
