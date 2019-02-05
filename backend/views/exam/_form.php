

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use app\components\CustomUrlRule;
use common\widgets\CKEditor;
use iutbay\yii2kcfinder\KCFinder;

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
/* @var $this yii\web\View */
/* @var $model common\models\Specialization */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-category-form">
    <div class="custumbox box box-info">
     <div class="box-body">

        <?php $form = ActiveForm::begin([
         'layout' => 'horizontal',
         'enableClientValidation' => true,
         'enableAjaxValidation' => false,
         'options' => ['enctype' => 'multipart/form-data'],
     ]);?>
     <br/>

     <?= $form->field($model, 'examcatID')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Search...'],
        'data' => $examcatID,
        'size' => Select2::SMALL,
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 1,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => \yii\helpers\Url::to(['exam-category/exam-category-list']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(type) { return type.text; }'),
            'templateSelection' => new JsExpression('function (type) { return type.text; }'),
        ],
    ]);?>

     <?= $form->field($model, 'courseID')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Search...'],
        'data' => $courseID,
        'size' => Select2::SMALL,
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 1,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            ],
            'ajax' => [
                'url' => \yii\helpers\Url::to(['courses/course-list']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(type) { return type.text; }'),
            'templateSelection' => new JsExpression('function (type) { return type.text; }'),
        ],
    ]);?>

     <?= $form->field($model, 'exam_dates')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

     <?= $form->field($model, 'process')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'exam_fullname')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'conductedBy')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'highlight')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'appform')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'eligibility')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'exam_center')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'cutt_off')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'selection_process')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'main_stream')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'summary')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>


  <?= $form->field($model, 'analysis')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'bylocation')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'question_paper')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'ans_key')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'counselling')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'syllabus')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'admit_card')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
          /* 'filebrowserUploadUrl' => Url::to(['course-documents/upload-image']),*/
      ]
  ]) ?>

  <?= $form->field($model, 'upload_guide')->widget(CKEditor::className(), [
      'options' => ['rows' => 6],
      'preset' => 'standard',
      'clientOptions'=>[
          'removePlugins' => 'save,newpage,print,pastetext,pastefromword,forms,language,flash,spellchecker,about,smiley,div,flag',
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

<?php $this->registerJs("".Yii::$app->myhelper->formsubmitedbyajax('w0','../exam/index')."");?>