<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use softark\duallistbox\DualListbox;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UniversitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'University: Courses';
$this->params['subtitle'] = '<h1>University: Courses <a class="btn btn-success btn-xs" href="'.Url::to(['add-courses','id'=>$university->id]).'">Add</a></h1>';
echo Yii::$app->message->display();
?>

<div class="university-index">
	<div class="custumbox box box-info">
		<div class="box-body">
			<?= GridView::widget([
            'striped'=>false,
            'hover'=>true,
            'panel'=>['type'=>'default', 'heading'=>'University Courses List','after'=>false],
            'toolbar'=> [
                '{export}',
                '{toggleData}',
            ],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                	'label'=>'Name',
                	'contentOptions' => ['style' => 'width:50%;'],
                    'attribute' => 'cname',
                    'value' => function($model){
                        return $model['course']['name'];
                    }
                ],
                [
                	'label'=>'Program',
                	'contentOptions' => ['style' => 'width:25%;'],
                    'attribute' => 'program',
                    'value' => function($model){
                        return $model['course']['program']['name'];
                    }
                ],
                [
                	'label'=>'Specialization',
                	'contentOptions' => ['style' => 'width:25%;'],
                    'attribute' => 'specialization',
                    'value' => function($model){
                        return $model['course']['specialization']['name'];
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