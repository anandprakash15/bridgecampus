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

  $this->title = $college->name.' Advertise Materials';
  $this->params['subtitle'] = '<h1>Advertise Materials</h1>';
  $this->params['breadcrumbs'][] = ['label' => 'Colleges', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $college->name;
  $this->params['breadcrumbs'][] = 'Advertise Materials';
}else{
  $this->title = $college->name.' Update Advertise Materials';
  $this->params['subtitle'] = '<h1>Update Advertise Materials</h1>';
  $this->params['breadcrumbs'][] = ['label' => 'Colleges', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $college->name;
  $this->params['breadcrumbs'][] = 'Update Advertise Materials';
}


?>
<div class="college-advertise-form">
  <div class="custumbox box box-info">
    <div class="box-body">
      <?php $form = ActiveForm::begin([
       'layout' => 'horizontal',
       'enableClientValidation' => true,
       'enableAjaxValidation' => false,
       'options' => ['enctype' => 'multipart/form-data'],
     ]);?>


     <?= $form->field($model, 'gtype')->dropDownList(Yii::$app->myhelper->getAdvertisePossition(),['class'=>'form-control'])?>
     <?php echo $form->field($model, 'urlImage')->widget(FileInput::classname(), [
      'pluginOptions' => [
        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
        'options' => ['multiple' => false],

        'initialPreview'=> $imgPreview,
        'initialPreviewConfig'=> [
          $imgPreviewConfig
        ],
        'initialPreviewAsData'=>true,
        'overwriteInitial'=>true,
        'dropZoneEnabled'=> false,
        'showCaption' => true,
        'showRemove' => false,
        'showUpload' => false,
      ],
    ]);?>

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