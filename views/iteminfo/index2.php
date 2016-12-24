<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;


$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="product-model">	 
	 <div class="container">

		
		 <div class="col-md-12 product-model-sec">
									
					<div class="item-info-index">
					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

					
						
						<?php
						
						
						 echo  ListView::widget([
								'dataProvider' => $dataProvider,	
								 'emptyText' => '<center><h2>No dishes added yet.</h2></center>',
								'itemOptions' => ['class' => 'item'],
						/*         'itemView' => function ($model, $key, $index, $widget) {
										return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
								}, */
							//	'itemView' =>'view'	,
										
								'itemView' => function ($model) {
								  // echo $id = $model->id;
									
									 return $this->render('_view2',['model' => $model]);
									// return $this->render('_view');
								}
								
						]); 

						?>
					</div>



			</div>
			
		</div>
</div>	



	