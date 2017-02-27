<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>

<?php
/* 
 $pjax = \yii\widgets\Pjax::begin();

echo \yii\widgets\ListView::widget([
    'dataProvider' => $livedataProvider,
    'options' => [
        'class' => '.list-view',
    ],
	'itemView' => function ($model) {
		 return $this->render('_viewcon',['model' => $model]);
	},
    'summary' => false,
    'layout' => '{sorter}{summary}{items}<div class="pagination-wrap">{pager}</div>',
    'pager' => [
        'class' => \darkcs\infinitescroll\InfiniteScrollPager::className(),
        'paginationSelector' => '.pagination-wrap',
        'pjaxContainer' => $pjax->id,
    ],
	'sorter' => [
		'options' => [
			'class' => 'sorterclass',
		],
	],
	'emptyText' => '<center></center>',
]);
\yii\widgets\Pjax::end();  */



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
							//	'itemView' =>'view'	,
										
								'itemView' => function ($model) {
								  // echo $id = $model->id;
									
									 return $this->render('_viewcon',['model' => $model]);
									// return $this->render('_view');
								}
								
						]);  
?>


					<br/><div class="clearfix">&nbsp;</div>

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