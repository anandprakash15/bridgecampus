<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\College */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="college-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cityID')->textInput() ?>

    <?= $form->field($model, 'stateID')->textInput() ?>

    <?= $form->field($model, 'countryID')->textInput() ?>

    <?= $form->field($model, 'taluka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'websiteurl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'establish_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approved_by')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'accredited_by')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'affiliate_to')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rating')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'vission')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mission')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'logourl')->textInput(['maxlength' => true]) ?>

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
