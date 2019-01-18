<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UniversitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $university->name.' Image Gallery';


$this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $university->name;
$this->params['breadcrumbs'][] = 'Image Gallery';
?>

<div class="university-index">
	<div class="custumbox col-md-12">
		<!-- Custom Tabs -->
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">Images</a></li>
				<li><a href="#tab_2" data-toggle="tab">Courses</a></li>
				
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<?php
					echo FileInput::widget([
    'name' => 'attachment_48[]',
    'options'=>[
        'multiple'=>true, 'accept' => 'image/*'
    ],
    'pluginOptions' => [
        'initialPreview'=>[],
        //'showPreview' => false,
        /*'uploadUrl' => Url::to(['/site/file-upload']),
        'uploadExtraData' => [
            'album_id' => 20,
            'cat_id' => 'Nature'
        ],*/
        'maxFileCount' => 10
    ]
]);
					?>
				</div>
				<!-- /.tab-pane -->
			</div>
			<!-- /.tab-content -->
		</div>
		<!-- nav-tabs-custom -->
	</div>
</div>