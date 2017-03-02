<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$livecount = $livedataProvider->getCount();
$offlinecount = $offlinedataProvider->getCount();

			if(Yii::$app->request->isAjax){
?>
					<div class="clearfix">&nbsp;</div>
					<div style="border: 1px solid #38b662;"></div>
					<div class="clearfix">&nbsp;</div>

<?php
			}

 					 	 echo  ListView::widget([
						//		'layout' => "{sorter}\n{summary}\n{items}\n{pager}",								
								'layout' => "{summary}\n{items}\n{pager}",								
								'dataProvider' => $livedataProvider,
								'summary'=>'', 			
							    'sorter' => [
									'options' => [
										'class' => 'sorterclass',
									],
								],
								'emptyText' => '<center></center>',
								'itemOptions' => ['class' => 'item'],
								'itemView' => function ($model) {
									 return $this->render('_viewcon',['model' => $model]);
									// return $this->render('_view');
								},
 	/* 							 'pager' => [
									'class' => \kop\y2sp\ScrollPager::className(),
									'triggerText' => 'Load More Items',
								 ]  */				 

						]);  

						if($livecount>0 and $offlinecount>0){
?>
					<div class="clearfix">&nbsp;</div>
					<div style="border: 1px solid #38b662;"></div>
					<div class="clearfix">&nbsp;</div>
					
						<?php
						}

 					 	 echo  ListView::widget([
								'layout' => "{summary}\n{items}\n{pager}",								
								'dataProvider' => $offlinedataProvider,
								'summary'=>'', 			
							    'sorter' => [
									'options' => [
										'class' => 'sorterclass',
									],
								],
								'emptyText' => '<center></center>',
								'itemOptions' => ['class' => 'item'],
								'itemView' => function ($model) {
									 return $this->render('_viewcon',['model' => $model]);
									// return $this->render('_view');
								},
 	/* 							 'pager' => [
									'class' => \kop\y2sp\ScrollPager::className(),
									'triggerText' => 'Load More Items',
								 ]  */				 

						]);  


						if($livecount<Yii::$app->params['pagination_item_count'] or $offlinecount<Yii::$app->params['pagination_item_count']){
						?>
						 
						 <script type="text/javascript">
							noresult = true;
						</script>	
						
						<?php
						}else{

						?>
								
						<!-- this will hold all the data -->
						<div id="results"></div>
						<!-- loading image -->
						<div id="loader_image">
						<img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/loader.gif'); ?>" style="display: none;margin: auto;"/>
						</div>

				<?php
						}
						
						if (!Yii::$app->request->isAjax){
 						if($livecount==0 and $offlinecount==0){
						?>						
							
						 <div class="registration">
										<br/><br/><br/><br/>
										<center><h2>
										No Dishes Found.	
										</h2></center>
							
							 <div class="clearfix"></div>
						 </div> 
						 <script type="text/javascript">
						  noresult = true;
						</script>

						<?php } ?>
						<?php } ?>
						


				