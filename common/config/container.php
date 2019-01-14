<?php 
use yii\helpers\Url;

\Yii::$container->set('yii\grid\GridView', 

    [
    'tableOptions' => [
        'class' => 'table table-striped table-condensed',
    ],
    'layout'=>"{items}\n{summary}\n{pager}",
    'rowOptions' => function ($model, $key, $index, $grid) {
        $url = Url::to(['update','id'=> $model['id']]);
        return ['onclick' => 'location.href="'.$url.'"'];
    },
]);

\Yii::$container->set('kartik\grid\GridView', [
    'containerOptions' => ['class'=>'panel panel-default'],
    'tableOptions' => [
        'class' => 'table table-striped table-condensed',
    ],
    'bordered'=>false,
    'responsiveWrap' => false,
    'responsive'=> true,
    'resizableColumns' => false,
    
    'layout'=>"{items}\n{summary}\n{pager}",
    'rowOptions' => function ($model, $key, $index, $grid) {
        $url = Url::to(['update','id'=> $model['id']]);
        return ['onclick' => 'location.href="'.$url.'"'];
    },
]);

\Yii::$container->set('yii\grid\SerialColumn', [
    'headerOptions' => ['style' => 'width:3%'],
]);


\Yii::$container->set('kartik\grid\ActionColumn', [
    'mergeHeader'=>false,
]);



\Yii::$container->set('yii\bootstrap\ActiveForm', [
    'layout' => 'horizontal',
	'fieldConfig' => [
		'horizontalCssClasses' => [
		'label' => 'col-sm-2',
		'wrapper' => 'col-sm-6',
	],
	],
]);

\Yii::$container->set('dosamigos\ckeditor\CKEditor', [
    'clientOptions'=>[
        'enterMode' => 2,
        'forceEnterMode'=>false,
        'shiftEnterMode'=>1,
    ],
]);

?>