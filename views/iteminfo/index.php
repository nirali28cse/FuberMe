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
<style>
.popover {
	width: 100%;
    max-width: 100%;
}
</style>
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
								 'emptyText' => '<center><h2>Start adding your dishes.</h2></center>',
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

						?>
					</div>



			</div>
			
		</div>
</div>	



<!-- Default bootstrap modal example -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    </div>
  </div>
</div>

	