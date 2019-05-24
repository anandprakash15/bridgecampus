<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use app\components\CustomUrlRule;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UniversitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if($model->isNewRecord){

  $this->title = $university->name.' Add Facility';
  $this->params['subtitle'] = '<h1>Add Facility</h1>';
  $this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $university->name;
  $this->params['breadcrumbs'][] = 'Add Facility';
}else{
  $this->title = $university->name.' Update Facility';
  $this->params['subtitle'] = '<h1>Update Facility</h1>';
  $this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $university->name;
  $this->params['breadcrumbs'][] = 'Update Facility';
}

/*$this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $universityandcourse->university->name;
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['courses','id'=>$universityandcourse->university->id]];
$this->params['breadcrumbs'][] = ['label' => $universityandcourse->course->name, 'url' => ['courses','id'=>$universityandcourse->university->id]];*/
//$this->params['breadcrumbs'][] = 'Add Facility';
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


     <?= $form->field($model, 'ftype')->dropDownList(Yii::$app->myhelper->getFacility(),['class'=>'form-control'])?>

     <?= $form->field($model, 'description')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
        'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,image,flag',
        /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
    ]) ?>

     <?= $form->field($facilityGallery, 'image[]')->widget(FileInput::classname(), [
      'options' => ['multiple' => true],
      'pluginOptions' => [
        'showUpload' => false,
        'allowedFileExtensions' => ['jpg','jpeg','png','gif', 'svg'],
        'initialPreviewAsData'=>true,
        'initialPreview'=> ArrayHelper::getColumn($imagesInitialPreviewConfig,'fileurl'),
        'initialPreviewConfig'=>$imagesInitialPreviewConfig
      ],
    ]); ?>

     <?= $form->field($facilityGallery, 'video[]')->widget(FileInput::classname(), [
      'options' => ['multiple' => true],
      'pluginOptions' => [
        'showUpload' => false,
        'allowedFileExtensions' => ['mp4','avi','mkv','mts','mpv','flv','3gp','avi'],
        'initialPreview'=> ArrayHelper::getColumn($videosInitialPreviewConfig,'fileurl'),
        'initialPreviewConfig'=>$videosInitialPreviewConfig
      ],
    ]); ?>

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