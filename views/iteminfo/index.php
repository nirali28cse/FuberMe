<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;

?>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



<div class="product-model">	 
	 <div class="container">

		
		 <div class="col-md-12 product-model-sec">
									
					<div class="item-info-index">
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

						<p>
							<?= Html::a('Add New Item', ['create'], ['class' => 'btn btn-success']) ?>
						</p>
						
						
						
						
						<?php
						
						
						 echo  ListView::widget([
								'dataProvider' => $dataProvider,
								'itemOptions' => ['class' => 'item'],
						/*         'itemView' => function ($model, $key, $index, $widget) {
										return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
								}, */
							//	'itemView' =>'view'	,
										
								'itemView' => function ($model) {
								  // echo $id = $model->id;
									
									 return $this->render('_view',['model' => $model]);
									// return $this->render('_view');
								}
								
						]); 

						

						/*
						GridView::widget([
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
												Yii::$app->homeUrl.'?r=itemimages/create&iteminfoid=1', 
												[
													'title' => 'Images',
													'data-pjax' => '0',
												]
											);
										},
									],
								],

							],
						]); 
						*/
						?>
					</div>



			</div>
			
		</div>
</div>	
<!---->
<div class="modal fade" id="bsModal3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="mySmallModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        Your content goes here...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>