<?php
use yii\helpers\Html;
$user_id=$model->chef_user_id;
?>

					<a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/update&id=<?php echo $model->id; ?>"><div class="product-grid love-grid">
						<div class="more-product"><span> </span></div>						
						<div class="product-img b-link-stripe b-animate-go  thickbox">
							<?php if($model->image==null){ ?>
								<img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/default_item_image.jpg'); ?>"  alt="item image">
							<?php }else{ ?>
								<img src="<?php echo  yii\helpers\Url::to('@web/fuberme/'.$user_id.'/item_images/'.$model->image); ?>" alt="FuberMe">
							<?php } ?>
								
						<!--	<div class="b-wrapper">
							<h4 class="b-animate b-from-left  b-delay03">							
							<button class="btns"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>Quick View</button>
							</h4>
							</div>  -->
						</div></a>						
						<div class="product-info simpleCart_shelfItem">
							<div class="product-info-cust">
								<h4><?php echo $model->name; ?></h4>

								<p>Availability : <br/><?php echo $model->availability_from_date.' '.Yii::$app->params['time_piker'][$model->availability_from_time]; ?>
								- <?php echo $model->availability_to_date.' '.Yii::$app->params['time_piker'][$model->availability_to_time]; ?></p>
								<span class="item_price">$ <?php echo $model->price; ?></span>


								<?php // yii\helpers\Html::a('<span class="glyphicon glyphicon-edit"></span>',['update','id'=>$model->id],['class'=>'item_add items','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Edit'] ) ?> 
								<?php // yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>',['delete','id'=>$model->id], ['onclick' => 'return confirm("Are you sure you want to delete this '.$model->name.' ?");','class'=>'item_add items','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Delete']) ?>
								<?php
								// echo date_default_timezone_get(); 

/* 								echo date("H:i:sa");
								 echo '<br/>';
								 echo $model->availability_from_time;
								 echo '<br/>';
								 echo $model->availability_to_time;  */
								// echo $newhours = date("H");
								$newdate = date("d-M-Y");
								$newdates = strtotime($newdate);
								$availability_to_date = strtotime($model->availability_to_date);
								$availability_from_date = strtotime($model->availability_from_date);
								$newhours = date("H");
								$newminiute = date("i");		
								//if($newminiute>=0 and $newminiute<=30) $newminiute = 00;
								//if($newminiute>=30 and $newminiute<=60) $newminiute = 30;
								$newTime = $newhours.':'.$newminiute;
								$newTime = strtotime($newTime); 
								$availability_from_time = strtotime($model->availability_from_time); 
								$availability_to_time = strtotime($model->availability_to_time); 
								
								$display_offline=0;
								if($availability_from_date<=$newdates and $newdates<=$availability_to_date){
									if($availability_from_date!=$newdates and $newdates!=$availability_to_date){
										$display_offline=1;
									}elseif($availability_from_date==$newdates and $newdates!=$availability_to_date){
										$display_offline=1;
									}else{
										if($availability_from_date==$newdates and ($newTime>=$availability_from_time and $availability_to_time>=$newTime)){
											$display_offline=1;
										}
										if($availability_to_date==$newdates and $newTime>=$availability_from_time and $availability_to_time>=$newTime){
											$display_offline=1;
										}
									}
								}
								
								if($display_offline==1){  
								?>
								<?= yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-close"></span> Take Offline','#',['class'=>'item_add','style'=>'background: lightgray;color: red;float: right;','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Make Offline']) ?>
								<?php }else{ ?>
								<?= yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-open"></span> Make Live','#',['class'=>'item_add items','style'=>'float: right;','data-toggle'=>'modal','data-html'=>true,'data-target'=>'#myModal']) ?>
								<?php } ?>
							</div>													
							<div class="clearfix"> </div>
						</div>
					</div>



		