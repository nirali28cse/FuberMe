
<style>
.glyphicon-eye-open:before {
    color: #38b662 !important;
}

.table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > th, .table > caption + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > td, .table > thead:first-child > tr:first-child > td {
    color: #38b662;
}
</style>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Pending Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-info-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<br>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'order_number',
          //  'final_amount',
          //  'total_amount',
           // 'user_id',
/*             'customer_name',
            'customer_email:email',
            'customer_mobile_no',
            'customer_address:ntext',
            'customer_city',
            'customer_state',
            'customer_zip', */
			[
            'attribute' => 'final_amount',
            'label' => 'Invoice Amount',
			'format' => 'html',
            'value' => function($model) { 
					return '$'.$model->final_amount;
				},
			],	
			[
            'attribute' => 'customer',
            'label' => 'Customer Info',
			'format' => 'html',
            'value' => function($model) { 
					return $model->customer_name.", <br/>".
						   $model->customer_email.", <br/>".
						   $model->customer_address.", <br/>".
						   $model->customer_city.",".
						   $model->customer_zip.","; 
				},
			],

            'delivery_method',		
            'payment_method',
            // 'tax_in_percent',          
           // 'order_status',
			[
            'attribute' => 'order_status',
            'label' => 'Order Status',
			'format' => 'html',
            'value' => function($model) { 
					return Yii::$app->params['order_status'][$model->order_status]; 
				},
			],
			
			'order_notes:ntext',
            // 'order_date_time',

 			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}',			
			],
        ],
		
    ]); ?>
</div>
