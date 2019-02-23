<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Advertise */

$this->title = 'Update Advertise: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Advertises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="advertise-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
		'coll_univID' => $coll_univID,
		'program' => $program,
		'course' => $course,
		'col_uni_adv'=>$col_uni_adv
	]) ?>

</div>
