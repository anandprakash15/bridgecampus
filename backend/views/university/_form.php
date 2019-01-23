<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use app\components\CustomUrlRule;
use dosamigos\ckeditor\CKEditor;
use backend\controllers\UserController;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Specialization */
/* @var $form yii\widgets\ActiveForm */

$validateUrl = ($model->isNewRecord)?Url::to(['university/validate']):Url::to(['university/validate','id'=>$model->id]);
?>

<div class="exam-category-form">
  <div class="custumbox box box-info">
   <div class="box-body">

    <?php $form = ActiveForm::begin([
     'layout' => 'horizontal',
     'enableClientValidation' => true,
     'enableAjaxValidation' => true,
     'validationUrl' => $validateUrl,
     'options' => ['enctype' => 'multipart/form-data'],
   ]);?>
   <br/>

   <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'code',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'address')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'standard',
    'clientOptions'=>[
      'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,image,flag',
      /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
    ]
  ]) ?>



   <?php

   $contriesList = UserController::actionGetCountrieslist();
   if($model->isNewRecord){
    $stateLists = UserController::actionGetStateslist();
    $citiesLists = UserController::actionGetCitieslist();
    $model->countryID = 101;/*india*/
    $model->stateID = 22;/*maharsahtra*/
  }else{
    if(!empty($model->countryID)){

      $stateLists = UserController::actionGetStateslist($model->countryID);
    }else{
      $stateLists = UserController::actionGetStateslist(101);
    }
    if(!empty($model->stateID)){
      $citiesLists = UserController::actionGetCitieslist($model->stateID);
    }else{
      $citiesLists = UserController::actionGetCitieslist(22);
    }
  }
  ?>

  <?= $form->field($model, 'countryID')->dropDownList(json_decode($contriesList,true),['class'=>'form-control input-sm',
    'onchange'=>'$.get("../user/get-stateslist?countryID="+$(this).val(), function( data ) {
      data = $.parseJSON(data);
      $(\'#university-stateid\').empty().append("<option value=\'\'>-- Select State --</option>");
      $(\'#university-cityid\').empty().append("<option value=\'\'>-- Select City --</option>");
      $.each(data, function(index, value) {
       $(\'#university-stateid\').append($(\'<option>\').text(value).attr(\'value\', index));
       });
       });
       ','prompt'=>'-- Select Country --'])?>

  <?= $form->field($model, 'stateID')->dropDownList(json_decode($stateLists,true),['class'=>'form-control input-sm','prompt'=>'-- Select State --',
    'onchange'=>'$.get("../user/get-citieslist?stateID="+$(this).val(), function( data ) {
     data = $.parseJSON(data);
     $(\'#university-cityid\').empty().append("<option value=\'\'>-- Select City --</option>");
     $.each(data, function(index, value) {
       $(\'#university-cityid\').append($(\'<option>\').text(value).attr(\'value\', index));
       });
       });
       '])?>

       <?= $form->field($model, 'cityID')->dropDownList(json_decode($citiesLists,true),['class'=>'form-control input-sm','prompt'=>'-- Select City --'])?>



       <?= $form->field($model, 'taluka')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'sortname')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>


       <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

       <?= $form->field($model, 'contact')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'standard',
        'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,image,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
        ]
      ]) ?>



      <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'websiteurl')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'establish_year')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'approved_by')->textarea(['rows' => 6]) ?>

      <?= $form->field($model, 'accredited_by')->textarea(['rows' => 6]) ?>

      <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>


      <?= $form->field($model, 'about')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'standard',
        'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,image,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
        ]
      ]) ?>

      <?php
      $bannerImgPreview = $brochureFilePreview = $logoImgPreview = "";
      if(!$model->isNewRecord){

        
        $fViewPath= Yii::$app->myhelper->getFileBasePath(1,$model->id);
        if(!empty($model->bannerURL)){
          $bannerImgPreview = [$fViewPath.$model->bannerURL];
        }
        if(!empty($model->brochureurl)){
          $brochureFilePreview = [$fViewPath.$model->brochureurl];
        }
        if(!empty($model->logourl)){
          $logoImgPreview = [$fViewPath.$model->logourl];
        }

      }

      ?>


      <?php echo $form->field($model, 'bannerImg')->widget(FileInput::classname(), [
        'pluginOptions' => [
          'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
          'options' => ['multiple' => false,'accept' => 'image/*'],
          'initialPreview'=> $bannerImgPreview,
          'initialPreviewAsData'=>true,
          'overwriteInitial'=>true,
          'dropZoneEnabled'=> false,
          'showCaption' => true,
          'showRemove' => false,
          'showUpload' => false,
          'uploadAsync'=>false,
        ]
      ]);?>

      <?php echo $form->field($model, 'brochureFile')->widget(FileInput::classname(), [
        'pluginOptions' => [
          'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
          'options' => ['multiple' => false,'accept' => 'image/*'],
          'initialPreview'=> $brochureFilePreview,
          'initialPreviewAsData'=>true,
          'overwriteInitial'=>true,
          'dropZoneEnabled'=> false,
          'showCaption' => true,
          'showRemove' => false,
          'showUpload' => false,
          'uploadAsync'=>false,
        ]
      ]);?>

      <?php echo $form->field($model, 'logoImg')->widget(FileInput::classname(), [
        'pluginOptions' => [
          'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
          'options' => ['multiple' => false,'accept' => 'image/*'],
          'initialPreview'=> $logoImgPreview,
          'initialPreviewAsData'=>true,
          'overwriteInitial'=>true,
          'dropZoneEnabled'=> false,
          'showCaption' => true,
          'showRemove' => false,
          'showUpload' => false,
          'uploadAsync'=>false,
        ]
      ]);?>
      <?= $form->field($model, 'status')->dropDownList(Yii::$app->myhelper->getActiveInactive(),['class'=>'form-control'])?>

      <div class="col-sm-offset-2 col-sm-4">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'load' ,'data-loading-text'=>"<i class='fa fa-spinner fa-spin '></i> Processing"]) ?>
      </div>

      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>

<?php $this->registerJs("".Yii::$app->myhelper->formsubmitedbyajax('w0','../university/index')."");?>