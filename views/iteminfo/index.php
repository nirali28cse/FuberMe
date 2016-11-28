<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-info-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'chef_user_id',
            'name',
            'price',
            'item_category_info_id',
            'item_cuisine_type_info_id',
            // 'ingredients:ntext',
            // 'description:ntext',
            'delivery_method',
            // 'head_up_time',
            'availability_from_date',
            'availability_from_time',  
			'availability_to_date',
            'availability_to_time',
            // 'date_time',
            'status',

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{images} {view} {update} {delete}',
				'buttons' => [
					'images' => function ($url) {
						return Html::a(
							'<span class="glyphicon glyphicon-picture"></span>',
							$url, 
							[
								'title' => 'Images',
								'data-pjax' => '0',
							]
						);
					},
				],
			],

        ],
    ]); ?>
</div>
