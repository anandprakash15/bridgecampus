<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */

$this->title = $model->name;
$this->params['subtitle'] = '<h1>'.$model->name.' '.Html::a('Edit', ['update','id'=>$model->id], ['class' => 'btn btn-success btn-xs']).'</h1>';
$this->params['breadcrumbs'][] = ['label' => 'Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$status = Yii::$app->myhelper->getActiveInactive();
?>
<div class="exam-view  row">
    <div class="col-md-12">
   <div class="custumbox box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Details</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="col-md-4">Program:</th>
                            <td class="col-md-8"><?= $model->examcatWithProgram->name ?></td>
                        </tr>
                        <tr>
                            <th class="col-md-4">Course:</th>
                            <td class="col-md-8"><?= $model->course->name ?></td>
                        </tr>                  
                        <tr>
                            <th class="col-md-4">Exam:</th>
                            <td class="col-md-8"><?= $model->name ?></td>
                        </tr>
                        <tr>
                            <th class="col-md-4">Full Name:</th>
                            <td class="col-md-8"><?= $model->exam_fullname ?></td>
                        </tr>
                        <tr>
                            <th class="col-md-4">Conducted By:</th>
                            <td class="col-md-8"><?= $model->conductedBy ?></td>
                        </tr>
                        <tr>
                            <th class="col-md-4">Status:</th>
                            <td class="col-md-8"><?= $status[$model->status] ?></td>
                        </tr>
                    </tbody>
                </table>
            </tbody>
        </table>
    </div>
</div>

<div class="custumbox box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Exam Dates</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->exam_dates ?>
    </div>
</div>

<div class="custumbox box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Process</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->process ?>
    </div>
</div>

<div class="custumbox box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Highlight</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->highlight ?>
    </div>
</div>

<div class="custumbox box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Appform</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->appform ?>
    </div>
</div>


<div class="custumbox box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Eligibility</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->eligibility ?>
    </div>
</div>


<div class="custumbox box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Exam Center</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->exam_center ?>
    </div>
</div>


<div class="custumbox box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Cutt Off</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->cutt_off ?>
    </div>
</div>


<div class="custumbox box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Selection Process</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->selection_process ?>
    </div>
</div>

<div class="custumbox box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Main Stream</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->main_stream ?>
    </div>
</div>


<div class="custumbox box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Summary</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->summary ?>
    </div>
</div>


<div class="custumbox box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Analysis</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->analysis ?>
    </div>
</div>


<div class="custumbox box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Location</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->bylocation ?>
    </div>
</div>


<div class="custumbox box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Question Paper</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->question_paper ?>
    </div>
</div>


<div class="custumbox box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Ans Key</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->ans_key ?>
    </div>
</div>


<div class="custumbox box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Counselling</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->counselling ?>
    </div>
</div>


<div class="custumbox box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Syllabus</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->syllabus ?>
    </div>
</div>


<div class="custumbox box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Admit Card</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->admit_card ?>
    </div>
</div>

<div class="custumbox box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Upload Guide</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->upload_guide ?>
    </div>
</div>

<div class="custumbox box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Admit Card</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <?= $model->admit_card ?>
    </div>
</div>
</div>
</div>
<?php 
$this->registerCss("
    .app-title{
       display: none;
   }
   .row{
        margin-right: 0px;
        margin-left: 0px;
   }
   ");
   ?>