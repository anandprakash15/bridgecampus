<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'examcatID')->textInput() ?>

    <?= $form->field($model, 'courseID')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'exam_dates')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'exam_fullname')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'conductedBy')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'process')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'highlight')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'eligibility')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'appform')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'exam_center')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'r_book')->textInput() ?>

    <?= $form->field($model, 'result')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cutt_off')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'selection_process')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'main_stream')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'analysis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'bylocation')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'question_paper')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ans_key')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'counselling')->textInput() ?>

    <?= $form->field($model, 'syllabus')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'admit_card')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'upload_guide')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'createdDate')->textInput() ?>

    <?= $form->field($model, 'updatedDate')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'createdBy')->textInput() ?>

    <?= $form->field($model, 'updatedBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
