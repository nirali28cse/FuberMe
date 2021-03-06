
<style>
.glyphicon-eye-open:before {
    color: #38b662 !important;
}

.summary{
	display: none;
}


@media (max-width: 768px){
	.top_left {
		width: 13%;
	}
}

</style>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Orders';
$this->params['breadcrumbs'][] = $this->title;


$dataProvidercount = $dataProvider->getCount();


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
            'attribute' => 'invoice_item',
            'label' => 'Order Item',
			'format' => 'html',
            'value' => function($model) { 
					$invoice_items=array();
					$invoice_item=null;					
					if(count($model->orderItemInfo)>0){
						foreach($model->orderItemInfo as $iteminfo){
							if(count($iteminfo->itemInfo)>0)
							$invoice_items[]=$iteminfo->itemInfo->name;
						}
						if(isset($_GET['sort']) and $_GET['sort']=='invoice_item'){
							sort($invoice_items);	
						}else{
							rsort($invoice_items);	
						}
						$invoice_item=implode(',',$invoice_items);
					}
					return $invoice_item;
				},
			],	
			
			[
            'attribute' => 'final_amount',
            'label' => 'Invoice Amount',
			'format' => 'html',
            'value' => function($model) { 
					return '$'.round($model->final_amount, 2);
				},
			],	
			
			[
            'attribute' => 'chef_name',
            'label' => 'Chef',
			'format' => 'html',
            'value' => function($model) { 
					$chef_name=null;
					if(count($model->orderItemInfo)>0){
						foreach($model->orderItemInfo as $iteminfo){
							$chef_name[$iteminfo->item_chef_user_id]=$iteminfo->chefInfo->username;
						}		
						if(isset($_GET['sort']) and $_GET['sort']=='invoice_item'){
							sort($chef_name);	
						}else{
							rsort($chef_name);	
						}						
						$chef_name=implode(',',$chef_name);
					}
					return $chef_name;
				},
			],	
			
			
			
/* 			[
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
			], */

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
			
			// 'order_notes:ntext',
             'order_date_time',

 			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view}',			
			],
        ],
		
    ]);

	if($dataProvidercount==0){ 
	?>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
	<?php } ?>
</div>
