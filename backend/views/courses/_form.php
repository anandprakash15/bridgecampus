<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use common\widgets\CKEditor;
use iutbay\yii2kcfinder\KCFinder;


/* @var $this yii\web\View */
/* @var $model common\models\Courses */
/* @var $form yii\widgets\ActiveForm */
$validateUrl = ($model->isNewRecord)?Url::to(['courses/validate']):Url::to(['courses/validate','id'=>$model->id]);

    $kcfOptions = array_merge(KCFinder::$kcfDefaultOptions, [
      'uploadURL' => Yii::$app->myhelper->getFileBasePath(),
      'access' => [
        'files' => [
          'upload' => true,
          'delete' => true,
          'copy' => true,
          'move' => true,
          'rename' => true,
        ],
        'dirs' => [
          'create' => true,
          'delete' => true,
          'rename' => true,
        ],
      ],
    ]);

    Yii::$app->session->set('KCFINDER', $kcfOptions);
?>

<div class="courses-form">
  <div class="custumbox box box-info">
   <div class="box-body">
    <?php $form = ActiveForm::begin([
     'layout' => 'horizontal',
     'enableClientValidation' => true,
     'enableAjaxValidation' => true,
     'validationUrl' => $validateUrl,
     'options' => ['enctype' => 'multipart/form-data'],
   ]);?>

    <?= $form->field($model, 'programID')->widget(Select2::classname(), [
      'options' => ['placeholder' => 'Search Program...'],
      'data' => $program,
      'size' => Select2::SMALL,
      'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 1,
        'language' => [
          'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
        ],
        'ajax' => [
          'url' => \yii\helpers\Url::to(['program/program-list']),
          'dataType' => 'json',
          'data' => new JsExpression('function(params) { 
            
            return {q:params.term}; 
          }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(type) { return type.text; }'),
        'templateSelection' => new JsExpression('function (type) { return type.text; }'),
      ],
    ]);?>

     <?= $form->field($model, 'program_categoryID')->widget(Select2::classname(), [
      'options' => ['placeholder' => 'Search...'],
      'data' => $program_categoryID,
      'size' => Select2::SMALL,
      'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 1,
        'language' => [
          'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
        ],
        'ajax' => [
          'url' => \yii\helpers\Url::to(['program-category/search-list']),
          'dataType' => 'json',
          'data' => new JsExpression('function(params) { 
            console.log($("#courses-programid").val());
            return {q:params.term,type:$("#courses-programid").val()}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(type) { return type.text; }'),
        'templateSelection' => new JsExpression('function (type) { return type.text; }'),
      ],
    ]);?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sortname')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'code',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'courselevel')->textInput() ?>

    <?= $form->field($model, 'full_part_time')->dropDownList(Yii::$app->myhelper->getFullPartTime(),['class'=>'form-control'])?>

    <?= $form->field($model, 'type')->dropDownList(Yii::$app->myhelper->getCDType(),['class'=>'form-control'])?>

    <?= $form->field($model, 'courseType')->dropDownList(Yii::$app->myhelper->getCourseType(),['class'=>'form-control'])?>


    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
        'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
        /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
    ]) ?>


    <?= $form->field($model, 'status')->dropDownList(Yii::$app->myhelper->getActiveInactive(),['class'=>'form-control'])?>

    <div class="col-sm-offset-2 col-sm-4">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'load' ,'data-loading-text'=>"<i class='fa fa-spinner fa-spin '></i> Processing"]) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
</div>


<?php $this->registerJs("".Yii::$app->myhelper->formsubmitedbyajax('w0','../course/index')."");?>