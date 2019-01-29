<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use app\components\CustomUrlRule;
use dosamigos\ckeditor\CKEditor;
use kartik\widgets\Select2;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UniversitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $college->name.' Add Courses Details';

$this->params['breadcrumbs'][] = ['label' => 'Colleges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $college->name;

if($model->isNewRecord){
$this->params['subtitle'] = '<h1>Add Courses Details</h1>';
$this->params['breadcrumbs'][] = "Add Courses Details";
}else{
  $this->params['subtitle'] = '<h1>Update Courses Details</h1>';
  $this->params['breadcrumbs'][] = "Update Courses Details";
}

/*$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['courses','id'=>$universityandcourse->university->id]];
$this->params['breadcrumbs'][] = ['label' => $universityandcourse->course->name, 'url' => ['courses','id'=>$universityandcourse->university->id]];
$this->params['breadcrumbs'][] = 'Details';*/
?>
<div class="course-details-form">
  <div class="custumbox box box-info">
    <div class="box-body">
      <?php $form = ActiveForm::begin([
       'layout' => 'horizontal',
       'enableClientValidation' => true,
       'enableAjaxValidation' => false,
       'options' => ['enctype' => 'multipart/form-data'],
     ]);?>


      <?= $form->field($uccModel, 'universityID')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Search University...'],
        'size' => Select2::SMALL,
        'data'=>$university,
        'pluginOptions' => [
          'allowClear' => true,

          'minimumInputLength' => 1,
          'language' => [
            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
          ],
          
          'ajax' => [
            'url' => \yii\helpers\Url::to(['university/university-list']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { 

              return {q:params.term}; 
            }')
          ],
          'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
          'templateResult' => new JsExpression('function(type) { return type.text; }'),
          'templateSelection' => new JsExpression('function (type) { return type.text; }'),
        ],
        "pluginEvents" => [
            "select2:select" => "function() {
              $('#universitycollegecourse-courseid').val(null).trigger('change');
            }",
          ],
      ]);?>


      <?= $form->field($uccModel, 'courseID')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Search Course...'],
        'size' => Select2::SMALL,
        'data'=>$course,
        'pluginOptions' => [
          'allowClear' => true,
          'minimumInputLength' => 1,
          'language' => [
            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
          ],
          'ajax' => [
            'url' => \yii\helpers\Url::to(['university/university-courses']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { 
              return {q:params.term,universityID:$("#universitycollegecourse-universityid").val()}; }')
          ],
          'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
          'templateResult' => new JsExpression('function(type) { return type.text; }'),
          'templateSelection' => new JsExpression('function (type) { return type.text; }'),
        ],
      ]);?>

      <?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'fees')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'standard',
        'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,image,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
        ]
      ]) ?>

      <?= $form->field($model, 'status')->dropDownList(Yii::$app->myhelper->getActiveInactive(),['class'=>'form-control'])?>

      <div class="form-group" style="margin-left: 18% !important;">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'load' ,'data-loading-text'=>"<i class='fa fa-spinner fa-spin '></i> Processing"]) ?>
      </div>

      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
<?php 
$this->registerCss("
  .app-title{
    display: none;
  }
  ");
  ?>

  <?php $this->registerJs("".Yii::$app->myhelper->formsubmitedbyajax('w0','../university/index')."");?>