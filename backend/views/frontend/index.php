<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SpecializationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Front End';
(count($dataProvider->getModels()) == 0)?
$this->params['subtitle'] = '<h1>Front End '.Yii::$app->myhelper->getCreatenew($roleid = array(1),'','Add').'</h1>':"";
$this->params['breadcrumbs'][] = $this->title;
$status = Yii::$app->myhelper->getActiveInactive();

echo Yii::$app->message->display();
?>

<div class="specialization-index">
    <div class="custumbox box box-info">
        <div class="box-body">
            <?= GridView::widget([
                'striped'=>false,
                'hover'=>true,
                'panel'=>['type'=>'default', 'heading'=>'Front End','after'=>false],
                /*'toolbar'=> [
                    '{export}',
                    '{toggleData}',
                ],*/
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],

                    [
                        'attribute' => 'about_status',
                        'filter' => $status,
                        'value' => function($model)use($status){
                            return $status[$model['about_status']];
                        }
                    ],
                    [
                        'attribute' => 'privacy_status',
                        'filter' => $status,
                        'value' => function($model)use($status){
                            return $status[$model['privacy_status']];
                        }
                    ],
                    [
                        'attribute' => 'term_condition_status',
                        'filter' => $status,
                        'value' => function($model)use($status){
                            return $status[$model['term_condition_status']];
                        }
                    ],
                ],
                'exportConfig'=> [
                    GridView::CSV=>[
                        'label' => 'CSV',
                    ],
                    GridView::EXCEL=>[
                        'label' => 'Excel',
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

