<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AdvertiseBannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Main Banner';
$this->params['subtitle'] = '<h1>Main Banner '.Yii::$app->myhelper->getCreatenew($roleid = array(1),'','Add').'</h1>';
$this->params['breadcrumbs'][] = $this->title;
$status = Yii::$app->myhelper->getActiveInactive();
$type = Yii::$app->myhelper->getAdvertisetype();
echo Yii::$app->message->display();
?>

<div class="advertise-banner-index">

    <div class="custumbox box box-info">
        <div class="box-body">
            <?= GridView::widget([
                'striped'=>false,
                'hover'=>true,
                'panel'=>['type'=>'default', 'heading'=>'Main Banner List','after'=>false],
                'toolbar'=> [
                    '{export}',
                    '{toggleData}',
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
            'institute_name',
            'short_name',
            // 'title_description',
            // 'sub_title_description',
            'image',
            'date_from',
            'to_date',
            //'country',
            //'state',
            //'city',
            //'url:url',
            [
                'attribute' => 'status',
                'filter' => $status,
                'value' => function($model)use($status){
                    return $status[$model['status']];
                }

            ],
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            // ['class' => 'yii\grid\ActionColumn'],
        ],'exportConfig'=> [
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

