<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\ExamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'examcatID') ?>

    <?= $form->field($model, 'courseID') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'exam_dates') ?>

    <?php // echo $form->field($model, 'exam_fullname') ?>

    <?php // echo $form->field($model, 'conductedBy') ?>

    <?php // echo $form->field($model, 'process') ?>

    <?php // echo $form->field($model, 'highlight') ?>

    <?php // echo $form->field($model, 'eligibility') ?>

    <?php // echo $form->field($model, 'appform') ?>

    <?php // echo $form->field($model, 'exam_center') ?>

    <?php // echo $form->field($model, 'r_book') ?>

    <?php // echo $form->field($model, 'result') ?>

    <?php // echo $form->field($model, 'cutt_off') ?>

    <?php // echo $form->field($model, 'selection_process') ?>

    <?php // echo $form->field($model, 'main_stream') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'analysis') ?>

    <?php // echo $form->field($model, 'bylocation') ?>

    <?php // echo $form->field($model, 'question_paper') ?>

    <?php // echo $form->field($model, 'ans_key') ?>

    <?php // echo $form->field($model, 'counselling') ?>

    <?php // echo $form->field($model, 'syllabus') ?>

    <?php // echo $form->field($model, 'admit_card') ?>

    <?php // echo $form->field($model, 'upload_guide') ?>

    <?php // echo $form->field($model, 'createdDate') ?>

    <?php // echo $form->field($model, 'updatedDate') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'updatedBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
