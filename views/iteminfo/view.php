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
					thumb_image_width: 300,
					thumb_image_height: 400,
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
								<a href="optionallink.html">
									
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
					 <div class="id"><h4><?php echo $model->chef_user_id; ?></h4></div>
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
								 <li><?php echo $model->item_cuisine_type_info_id.','.$model->item_category_info_id.','.$model->item_dietary_preference; ?></li>
								 <li>Order Price:</li>
								 <li class="active">$ <?php echo $model->price; ?></li>
								 <a href="#">Order NOW</a>
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
							 <li>Delivery Methods : 
							 <?php if($model->delivery_method!='both') echo Yii::$app->params['delivery_method'][$model->delivery_method]; else echo 'Pickup,Home Delivery'; ?>
							 </li>
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
								->orderBy(['rand()' => SORT_DESC])
								->all();
				
				if(count($random_chef_items)>0){
				?> 
		  
				  
				<div class="sofaset-info">
						 <h4>Special Dishes By Chef</h4>
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
									<!--  <span>ID: DB4790</span> -->
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

