<style>
.itemerrorclass{
	font-size: 14px;
    color: #ff1414;
    padding: 10px 0px;
}
</style>

<?php
use yii\helpers\Html;
use app\models\ItemInfo;

$user_id=$model->chef_user_id;
$default_itemimage=yii\helpers\Url::to('@web/fuberme/images/default_item_image.jpg');
if($model->image==null){
	$item_image=$default_itemimage;
}else{
	$item_image=yii\helpers\Url::to('@web/fuberme/'.$user_id.'/item_images/'.$model->image);
}
?>
<script>
			jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 350,
					thumb_image_height: 250,
					source_image_width: 900,
					source_image_height: 1200,
					show_hint: true,
					click_callback: function(image_anchor, instance_id){
						alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
					}
				});

			});
</script>

<!---->
<div class="single-sec">
	 <div class="container">

		 <!-- start content -->	
			<div class="col-md-12 det">
				  <div class="single_left">
					 <div class="grid images_3_of_2">
						 <ul id="etalage">
							<li>
								<a href="#">									
									<img class="etalage_thumb_image" src="<?php echo  $item_image; ?>" class="img-responsive" />
									<img class="etalage_source_image" src="<?php echo  $item_image; ?>" class="img-responsive" title="" />
								</a>
							</li>

						 </ul>
						 <div class="clearfix"></div>		
				      </div>
				  </div>
				  <div class="single-right">
					 <h3><?php echo $model->name; ?></h3>
					 <div class="id"><h4><?php echo $model->chefUser->username; ?> From <?php echo $model->chefUser->city; ?></h4></div>
					 <?php /*
					  <form action="" class="sky-form">
						     <fieldset>					
							   <section>
							     <div class="rating">
									<input type="radio" name="stars-rating" id="stars-rating-5">
									<label for="stars-rating-5"><i class="icon-star"></i></label>
									<input type="radio" name="stars-rating" id="stars-rating-4">
									<label for="stars-rating-4"><i class="icon-star"></i></label>
									<input type="radio" name="stars-rating" id="stars-rating-3">
									<label for="stars-rating-3"><i class="icon-star"></i></label>
									<input type="radio" name="stars-rating" id="stars-rating-2">
									<label for="stars-rating-2"><i class="icon-star"></i></label>
									<input type="radio" name="stars-rating" id="stars-rating-1">
									<label for="stars-rating-1"><i class="icon-star"></i></label>
									<div class="clearfix"></div>
								 </div>
							  </section>
						    </fieldset>
					  </form>
					  */
					  ?>
					  <div class="cost">
						 <div class="prdt-cost">
							 <ul>								 							 
								 <li><?php echo $model->cuisineTypeInfo->name.','.$model->itemCategoryInfo->name; ?></li>
								 <li>Order Price </li>
								 <li class="active">$ <?php echo $model->price; ?></li>
								 
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
									<div class="itemerrorclass itemerror<?php echo $model->id; ?>"></div>
									<?= yii\helpers\Html::a('Order Now <span class="glyphicon glyphicon-chevron-right"></span>',['/orderinfo/review','itemid'=>$model->id],['class'=>'item_add items placeorder','id'=>$model->id]) ?>
								<?php }else{ ?>								
								   <?= yii\helpers\Html::a('<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;&nbsp;Currently Offline','#',['class'=>'item_add','style'=>'background: lightgray;color: red;']) ?>
								  
								<?php } ?>
						
								 
							 </ul>
						 </div>
<!-- 						 <div class="check">
							 <p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>Enter pin code for delivery & availability</p>
							 <form class="navbar-form navbar-left" role="search">
								  <div class="form-group">
									<input type="text" class="form-control" placeholder="Enter Pin code">
								  </div>
								  <button type="submit" class="btn btn-default">Verify</button>
							 </form>
						 </div> -->
						 <div class="clearfix"></div>
					  </div>
					  <div class="item-list">
						 <ul>
							
							 <li>Preparation Time : <?php echo Yii::$app->params['head_up_time'][$model->head_up_time]; ?></li>
							 <?php if($model->ingredients!=null){ ?>
							 <li>Ingredients : <?php echo $model->ingredients; ?></li>
							 <?php }  ?>
						 </ul>
					  </div>
					  
					  
					  <?php if($model->description!=null){ ?>
						  <div class="single-bottom1">
							<h6>Details</h6>
							<p class="prod-desc"><?php echo $model->description; ?></p>
						 </div>	
					  <?php }  ?>
	
					 
				  </div>
				  <div class="clearfix"></div>
				  
				  
				<?php
				//get related item of this chef_user_id
				$random_chef_items= ItemInfo::find()
								->where(['chef_user_id' => $user_id])
								->andWhere(['!=','id',$model->id])
								->orderBy(['status' => SORT_DESC])
								->all();
				
				if(count($random_chef_items)>0){
				?> 
		  
				  
				<div class="sofaset-info">
						 <h4>Other Dishes By Chef <?php echo $model->cuisineTypeInfo->name; ?></h4>
						<div class="seller-grids">						
							<?php foreach($random_chef_items as $random_chef_item){
									$image_src=$default_itemimage;
									$item_view=Yii::$app->homeUrl.'?r=iteminfo/view&id='.$random_chef_item->id;
									if($random_chef_item->image!=null){
										$image_src=yii\helpers\Url::to('@web/fuberme/'.$random_chef_item->chef_user_id.'/item_images/'.$random_chef_item->image);
									}
							?>  
								 <div class="col-md-3 seller-grid">
									 <a href="<?php echo $item_view; ?>"><img src="<?php echo $image_src; ?>" alt=""/></a>
									 <h4><a href="products.html"><?php echo $random_chef_item->name; ?></a></h4>
									 <span><?php echo $random_chef_item->cuisineTypeInfo->name.','.$random_chef_item->itemCategoryInfo->name; ?></span> 
									 <br/>
									 <span>Preparation Time : <?php echo Yii::$app->params['head_up_time'][$random_chef_item->head_up_time]; ?></span> 
									 <p>$ <?php echo $random_chef_item->price; ?></p>
								 </div>
							<?php } ?> 							 
							 <div class="clearfix"></div>
						</div>						 
				</div>
				<?php } ?>  
				
		    </div>
				
			

		     <div class="clearfix"></div>
	  </div>	 
</div>

<script>
$(document).ready(function(){
	$(document).on("click",".placeorder",function(e){		
		e.preventDefault();
		var oldHref = $(this).attr('href');
		var item_id=$(this).attr('id');
		$.ajax({			
			type: 'POST',
			url: <?php Yii::$app->homeUrl; ?>'?r=orderinfo/checkchef',
			data: {item_id:item_id},			
			error: function (err) {
			//	alert("error - " + err);
				return false;
			},
			success: function (data1) {
				// return false;
				// alert(data1);
				if(data1==0){	
					$('.itemerror'+item_id).html('Sorry,This item cannot be added.');
					return false;
				}else if(data1==3){	
					$('.itemerror'+item_id).html('Sorry,This item cannot be added,Due to less Qty.');
					return false;
				}else if(data1==4){	
					$('.itemerror'+item_id).html('Sorry,you can not purchase your own item.');
					return false;
				}else{					
					 window.location.href = oldHref; // go to the new url
				}				
			}
		});
	});
});
</script>
