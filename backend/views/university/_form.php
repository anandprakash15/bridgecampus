<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\University */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="university-form">
    <div class="custumbox box box-info">
     <div class="box-body">
        <?php $form = ActiveForm::begin([
           'layout' => 'horizontal',
           'enableClientValidation' => true,
           'enableAjaxValidation' => false,
           'options' => ['enctype' => 'multipart/form-data'],
       ]);?>

       <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

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

       <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

       <?= $form->field($model, 'brochureurl')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'logourl')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'status')->dropDownList(Yii::$app->myhelper->getActiveInactive(),['class'=>'form-control'])?>

     <div class="col-sm-offset-2 col-sm-4">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'load' ,'data-loading-text'=>"<i class='fa fa-spinner fa-spin '></i> Processing"]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
