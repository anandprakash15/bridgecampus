<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UniversitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Universities';
$this->params['subtitle'] = '<h1>Universities '.Yii::$app->myhelper->getCreatenew($roleid = array(1),'','Add').'</h1>';
$this->params['breadcrumbs'][] = $this->title;
$status = Yii::$app->myhelper->getActiveInactive();

echo Yii::$app->message->display();
?>
<div class="university-index">
    <div class="custumbox box box-info">
       <div class="box-body">
        <?= GridView::widget([
            'striped'=>false,
            'hover'=>true,
            'panel'=>['type'=>'default', 'heading'=>'University List','after'=>false],
            'toolbar'=> [
                '{export}',
                '{toggleData}',
            ],
            'rowOptions' => function ($model, $key, $index, $grid) {
                $url = Url::to(['view','id'=> $model['id']]);
                return ['onclick' => 'location.href="'.$url.'"'];
            },
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                'code',
                'address',
                'cityID',
            //'stateID',
            //'countryID',
            //'taluka',
            //'district',
            //'pincode',
            //'contact',
            //'fax',
            //'email:email',
            //'websiteurl',
            //'establish_year',
            //'approved_by:ntext',
            //'accredited_by:ntext',
            //'grade',
            //'about:ntext',
            //'brochureurl',
            //'logourl',
            //'createdDate',
            //'updatedDate',
            //'status',
            //'createdBy',
            //'updatedBy',

                ['class' => 'yii\grid\ActionColumn'],
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