<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DietaryPreferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dietary Preferences';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dietary-preference-index">


    <p>
        <?= Html::a('Create Dietary Preference', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'name',
             [
				'attribute' => 'status',
				'format' => 'raw',
				'value' => function ($model) {
					return $model->status == 0 ? "In Active" : "Active";
				},
			],
         //   'date_time',

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
			],
        ],
    ]); ?>
</div>
