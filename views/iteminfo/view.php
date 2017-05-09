<style>
.itemerrorclass{
	font-size: 14px;
    color: #ff1414;
    padding: 10px 0px;
}


.otheritem{
    font-size: 0.9em;
    font-weight: 600;
    padding: 10px 0;
    text-transform: uppercase;
    color: #38b662;
    border-bottom: 1px solid rgb(236, 236, 236);
    margin-bottom: 1em;
	
}	


.list-view>.item{float:left;width: 345px;padding: 0.5%;}

.product-grid {
    width: 100%;
}


.sofa-grid h4 a{
    background: #38b662;
	color: White;
	border-radius: 0;
}
.itemerrorclass{
    font-size: 14px;
    color: #ff1414;
    margin: 95px 15px;
    display: block;
    clear: both;
    position: absolute;
}


.items{
    float: left;
    margin: 0 0 16px 0px;
    display: block;
    clear: both;
}

.pagination {
    display: none;
}


.col-md-12{
    padding-right: 0;
    padding-left: 0;
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
	$default_itemimage1=yii\helpers\Url::to('@web/fuberme/'.$user_id.'/item_images/'.$model->image);
	if ((file_exists($default_itemimage1))) {   
		$item_image=$default_itemimage1;                        
	}else{
		$item_image=$default_itemimage;
	}
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
				  <div class="clearfix">&nbsp;</div>
				  <div class="clearfix">&nbsp;</div>
				  <div class="clearfix">&nbsp;</div>
				  
				  
				
				<h4 class="otheritem" > Other Dishes By Chef <?php echo $model->chefUser->username; ?></h4>

				   <div class="product-model">	 
					 <div class="container" style="padding: 0;margin: 0;width: 100%;">
						 <div class="col-md-12 product-model-sec">									
								<div class="item-info-index">
										<?php	
									
												echo $this->render('/iteminfo/conhomeitem', [
													'livedataProvider' => $livedataProvider,
													'offlinedataProvider' => $offlinedataProvider,
												]);

										?>		
										
								</div>
							</div>
						</div>
					</div>
						
					<div class="clearfix"></div>

		
				
		    </div>
				
			

		     <div class="clearfix"></div>
	  </div>	 
</div>

	
	
	
<script type="text/javascript">

// infinite scroll 
var noresult = false;
var busy = false;
var limit = 5
var offset = 0;

function displayRecords(lim, off) {
        $.ajax({
          type: "GET",
          async: false,
          url: <?php Yii::$app->homeUrl; ?>'?r=iteminfo/conhome',
          data: "per-page=" + lim + "&page=" + off,
          cache: false,
          beforeSend: function() {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
          },
          success: function(html) {
			//  alert(html);
            $("#results").append(html);
            $('#loader_image').hide();
            if (html == "") {
              $("#loader_message").html('<button data-atr="nodata" class="btn btn-default" type="button">No more records.</button>').show()
            } else {
              $("#loader_message").html('<button class="btn btn-default" type="button">Loading please wait...</button>').show();
            }
            window.busy = false;

          }
        });
}

$(document).ready(function() {

$(window).scroll(function() {
          // make sure u give the container id of the data to be loaded in.
          if ($(window).scrollTop() + $(window).height() > $("#results").height() && !busy) {
            busy = true;
       //     offset = limit + offset;
			offset=offset+1;
				
			if(!noresult){
				displayRecords(limit, offset);	
			}	
            

          }
});

});
// infinite scroll 
</script>
