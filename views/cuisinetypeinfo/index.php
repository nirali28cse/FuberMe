<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuisineTypeInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuisine Type Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuisine-type-info-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= Html::a('Create Cuisine Type Info', ['create'], ['class' => 'btn btn-success']) ?>

	
	
	
	
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'name',
         //   'chef_user_id',
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
