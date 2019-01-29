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

  $this->title = $college->name.' Add Facility';
  $this->params['subtitle'] = '<h1>Add Facility</h1>';
  $this->params['breadcrumbs'][] = ['label' => 'College', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $college->name;
  $this->params['breadcrumbs'][] = 'Add Facility';
}else{
  $this->title = $college->name.' Update Facility';
  $this->params['subtitle'] = '<h1>Update Facility</h1>';
  $this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $college->name;
  $this->params['breadcrumbs'][] = 'Update Facility';
}

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