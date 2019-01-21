<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\University */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-view">

   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'code',
            'address',
            'cityID',
            'stateID',
            'countryID',
            'taluka',
            'district',
            'pincode',
            'contact',
            'fax',
            'email:email',
            'websiteurl',
            'establish_year',
            'approved_by:ntext',
            'accredited_by:ntext',
            'grade',
            'about:ntext',
            'brochureurl',
            'logourl',
            'createdDate',
            'updatedDate',
            'status',
            'createdBy',
            'updatedBy',
        ],
    ]) ?>

</div>
