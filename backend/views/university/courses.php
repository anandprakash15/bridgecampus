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
$this->params['subtitle'] = '<h1>University: Courses '.Yii::$app->myhelper->getCreatenew($roleid = array(1),'','Add').'</h1>';?>
<div class="university-index">
	<div class="custumbox box box-info">
		<div class="box-body">
			<?php $form = ActiveForm::begin(); ?>
			<?php
			$options = [
				'multiple' => true,
				'size' => 20,
			];
    // echo $form->field($model, $attribute)->listBox($items, $options);
			echo $form->field($ucmodel, 'courseID')->widget(DualListbox::className(),[
				'items' => $courses,
				'options' => [],
				'clientOptions' => [
					'moveOnSelect' => false,
					'selectedListLabel' => 'Selected Courses',
					'nonSelectedListLabel' => 'Course List',
				],
			])->label(false);
			?>
			<div class="form-group">
				<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
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