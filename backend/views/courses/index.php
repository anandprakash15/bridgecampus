<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['subtitle'] = '<h1>Courses '.Yii::$app->myhelper->getCreatenew($roleid = array(1),'','Add').'</h1>';
$this->params['breadcrumbs'][] = $this->title;
$status = Yii::$app->myhelper->getActiveInactive();

echo Yii::$app->message->display();
?>
<div class="courses-index">
    <div class="custumbox box box-info">
     <div class="box-body">
        <?= GridView::widget([
            'striped'=>false,
            'hover'=>true,
            'panel'=>['type'=>'default', 'heading'=>'Course List','after'=>false],
            'toolbar'=> [
                '{export}',
                '{toggleData}',
            ],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'contentOptions' => ['style' => 'width:30%;'],
                    'attribute' => 'name',
                ],
                [
                    'contentOptions' => ['style' => 'width:10%;'],
                    'attribute' => 'code',
                ],
                [
                    'label'=>'Program',
                    'contentOptions' => ['style' => 'width:20%;'],
                    'attribute' => 'program',
                    'value' => function($model){
                        return $model['program']['name'];
                    }
                ],
                [
                    'label'=>'Specialization',
                    'contentOptions' => ['style' => 'width:20%;'],
                    'attribute' => 'specialization',
                    'value' => function($model){
                        return $model['specialization']['name'];
                    }
                ],
                [
                    'attribute' => 'status',
                    'filter' => $status,
                    'value' => function($model)use($status){
                        return $status[$model['status']];
                    }

                ],
                
            ],
        ]); ?>
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