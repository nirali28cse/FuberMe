<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>

<?php


						 echo  ListView::widget([
								'layout' => "{sorter}\n{summary}\n{items}\n{pager}",								
								'dataProvider' => $livedataProvider,
								'summary'=>'', 		
							    'sorter' => [
									'options' => [
										'class' => 'sorterclass',
									],
								],
								'emptyText' => '<center></center>',
								'itemOptions' => ['class' => 'item'],
						/*         'itemView' => function ($model, $key, $index, $widget) {
										return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
								}, */
							//	'itemView' =>'view'	,
										
								'itemView' => function ($model) {
								  // echo $id = $model->id;
									
									 return $this->render('_viewcon',['model' => $model]);
									// return $this->render('_view');
								}
								
						]); 
?>


						<?php					
						 echo  ListView::widget([
							//	'layout' => "{sorter}\n{summary}\n{items}\n{pager}",
								'summary'=>'', 							
								'dataProvider' => $offlinedataProvider,
								'emptyText' => '<center></center>',
								'itemOptions' => ['class' => 'item'],	
								'itemView' => function ($model) {
								  // echo $id = $model->id;
									
									 return $this->render('_viewcon',['model' => $model]);
									// return $this->render('_view');
								}
								
						]); 
						
						$livecount = $livedataProvider->getCount();
						$offlinecount = $offlinedataProvider->getCount();

						if($livecount==0 and $offlinecount==0){
						?>
						
					 <div class="registration">
									<br/><br/><br/><br/>
									<center><h2>
									No Dishes Found.	
									</h2></center>
						
						 <div class="clearfix"></div>
					 </div>
						
						<?php } ?>