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

$this->title = $university->name.' Review Details';
$this->params['subtitle'] = '<h1>Review Details</h1>';
$this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $university->name;
$this->params['breadcrumbs'][] = ['label' =>$model->createdBy0->fullname , 'url' => ['user/update','id'=>$model->createdBy0->id]];
$this->params['breadcrumbs'][] = 'Review Details';
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
            <?= $form->field($model, 'status')->dropDownList(Yii::$app->myhelper->getActiveInactive(),['class'=>'form-control'])?>

            <div class="col-sm-offset-2 col-sm-4">
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