<style>

@media screen and (max-width: 768px)
{
	.cart-item-info {
		clear: both;
	}
	.cart-item img {
		width: auto;
	}
}

.cart-item {
    width: 10%;
	padding: 0;
	margin-right: 0;
}
.cart-item-info h3 {
    margin-top: 0;
}

.cartprice{
	font-size: 25px;
    font-weight: 600;
    color: #38b662;
    font-family: monospace;
}
.cart-item-info {
    border-bottom: 0px solid;
	padding: 1em;
}
.cart-sec {
    padding: 0;
}
.seller-grid {
    padding-bottom: 3%;
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


.list-view>.item{float:left; width:auto;padding: 1%;}

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
use app\modules\users\models\Userdetail;


$order_items=null;
$order_items=$order_array['order_item'];
$default_itemimage=yii\helpers\Url::to('@web/fuberme/images/default_item_image.jpg');

$user_id=$master_chef;

$user_info = Userdetail::find()->where([ 'id'=>$user_id,'status'=>1 ])->one();
$master_chef_name=null;
$master_chef_city=null;
$master_chef_zipcode=null;
if(count($user_info)>0){
	$master_chef_name=$user_info->username;	
	$master_chef_city=$user_info->city;	
	$master_chef_zipcode=$user_info->zipcode;	
} 

?>	


	<?php if(count($order_items)>0){ ?>
		 
			<div class="cart_main">
				 <div class="container">
					
					 <div class="cart-items">
					 
					   <div class="row">
						   <div class="col-sm-6"><h2>Review Your Order</h2>	</div>																			
						   <div class="col-sm-6">
							   <p style="text-align:right;font-size: 15px;color: gray;">
							   Chef City : <?php echo $master_chef_city.' ('.$master_chef_zipcode.')'; ?>
							   </p>
						   </div>																			
					   </div>
					   
						 					
						

					   <div class="row">
						   <div class="col-sm-6"></div>																			
						  <div class="col-sm-1" style="padding: 0;width: 6%;">Qty</div>
						  <div class="col-sm-4" style="padding: 0;">Price</div>  
					   </div>

									  	  

						<?php foreach($order_items as $value){ ?>
						

							 <div class="cart<?php echo $value['item_id']; ?>">
								 <div class="cart-header2">
								 

									  <div class="cart-sec">
											<div class="cart-item">
												 <img src="<?php echo $value['item_image']; ?>"/>
											</div>
											
											
										   <div class="cart-item-info">
											   <div class="row">
											       <div class="col-sm-6">
													 <h3><?php echo $value['item_name']; ?>
													 <span>													 
														<?php echo $value['item_cuisine_type']; ?>
														<br/> <?php echo $value['item_ingredients']; ?>
													 </span>
													 <h3>
													 </h3>
												   </div>
																									
												  <div class="col-sm-1">													 
													 <?php
													 $item_chef_quantity=0;
													 $item_quantity_array=array();
													 $item_chef_quantity=$value['item_chef_quantity'];
													 for($count=1;$count<=$item_chef_quantity;$count++){
														$item_quantity_array[$count]=$count;	 
													 }
													 ?>
													 <span>

														 
													<?php 
														echo  Html::dropDownList( 'itemqty'.$value['item_id'], 
															 $value['item_qty'],  
															 $item_quantity_array, 
															 ['id'=>'itemqty'.$value['item_id'],'style'=>'margin-top: 5px;padding: 3px;']
														)
													?>

													 </span>
												  </div>
												  <div class="col-sm-4 cartprice"><span>$</span><?php echo $value['item_price']; ?></div>  
											   </div>
										   </div>
									  	  <div class="col-sm-1" style="padding: 1em;float: right;">									 
												<a href="<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/review&itemid=<?php echo $value['item_id']; ?>&ditem=<?php echo $value['item_id']; ?>">  <span class="glyphicon glyphicon-trash" style="font-size: 20px;color: red;"></span></a>
										  </div>
										   <div class="clearfix"></div>		
									  </div>
									  
									  

									
								  </div>	
							  </div>	

							  
<script type="text/javascript">															
	$(document).ready(function(){
		$('select[name=\"itemqty<?php echo $value['item_id']; ?>\"]').change(function(){
			var new_qty =$('select[name=\"itemqty<?php echo $value['item_id']; ?>\"]').val();
			var item_id='<?php echo $value['item_id']; ?>';
			$.ajax({
				url: '<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/changeqty',
				type: 'POST',
				data: {new_qty:new_qty,item_id:item_id},
				success: function(myArray) {
					//finished
					// location.reload();
					var myArray = jQuery.parseJSON(myArray);
					var total_amount='$'+myArray['total_amount'];
					var final_amount='$'+myArray['final_amount'];
					$(".tamount").html(total_amount);
					$(".ttfinal").html(final_amount);
				}
			});
		});
	});
</script>

						 <?php } ?>
 
					 </div>
					 
					 <div class="cart-total">

						 <div class="price-details" style="border-bottom: 0px solid;">
							 <h3>Price Details</h3>
							 <span>Total</span>
							 <span class="total tamount">$ <?php echo $order_array['total_amount']; ?></span>
						
						<?php if($order_array['tax_in_percent']>0){ ?>
							 <span>Paypel Charges (%)</span>
							 <span class="total"><?php echo $order_array['tax_in_percent']; ?></span>
							 		
							 <div class="clearfix"></div>

						 <h4 class="last-price">Final Total</h4> 
						 <span class="total final ttfinal"><?php echo $order_array['final_amount']; ?></span>
						<?php } ?>
						
						 <div class="clearfix">&nbsp;</div>
						<?php if(Yii::$app->user->isGuest){ ?>
								<a class="continue" href="<?php echo Yii::$app->homeUrl; ?>?r=users/registration/cindex&directorder=<?php echo $value['item_id']; ?>">CheckOut</a>						
						<?php }else{ ?>							
							 <a class="continue" href="<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/create">CheckOut</a>
						<?php } ?>
						
						<?php /* <a class="continue" href="#" style="background: gray;">Coming Soon…</a> */ ?>
						</div>
				 </div>
				  <div class="clearfix"></div>
				 

				 
						 <h4 class="otheritem" > Other Dishes By Chef <?php  echo $master_chef_name; ?></h4>

						   <div class="product-model">	 
							 <div class="container" style="padding: 0;margin: 0;">
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

				 
				 
	<?php


				//get related item of this chef_user_id
/* 				$random_chef_items= ItemInfo::find()
								->where(['chef_user_id' => $user_id])
							//	->where(['status' => 1])
								// ->andWhere(['!=','id',$model->id])
								->orderBy(['status' => SORT_DESC])
								->all(); 
				
				if(count($random_chef_items)>0){
				?> 
		  
				  
				<div class="sofaset-info" style="margin: 0px;">
						 <h4>Other Dishes By Chef <?php  echo $master_chef_name; ?></h4>
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
									 
									 <div>
 
								<?php
			
								$newdate = date("d-M-Y");
								$newdates = strtotime($newdate);
								$availability_to_date = strtotime($random_chef_item->availability_to_date);
								$availability_from_date = strtotime($random_chef_item->availability_from_date);
								$newhours = date("H");
								$newminiute = date("i");		
								//if($newminiute>=0 and $newminiute<=30) $newminiute = 00;
								//if($newminiute>=30 and $newminiute<=60) $newminiute = 30;
								$newTime = $newhours.':'.$newminiute;
								$newTime = strtotime($newTime); 
								$availability_from_time = strtotime($random_chef_item->availability_from_time); 
								$availability_to_time = strtotime($random_chef_item->availability_to_time); 
								
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
									<div class="itemerrorclass itemerror<?php echo $random_chef_item->id; ?>"></div>
									<?= yii\helpers\Html::a('Order Now <span class="glyphicon glyphicon-chevron-right"></span>',['/orderinfo/review','itemid'=>$random_chef_item->id],['class'=>'item_add items placeorder','style'=>'color: white;','id'=>$random_chef_item->id]) ?>
								<?php }else{ ?>								
								   <?= yii\helpers\Html::a('<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;&nbsp;Currently Offline','#',['class'=>'item_add','style'=>'background: lightgray;color: red;']) ?>
								  
								<?php } ?>
						
									 
									 </div>
									 
								 </div>
								
								 
								 
							<?php } ?> 							 
							 <div class="clearfix"></div>
						</div>						 
				</div>
				<?php } 
				*/
				?>  
				 
				 
				 
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


	 <?php }else{ 
	 		unset($_SESSION['order_array']);
			unset($_SESSION['master_chef']);
	 ?>
	 
			<script type="text/javascript">
			history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
			window.addEventListener('popstate', function(event) {
				window.location.assign("<?php echo Yii::$app->homeUrl; ?>");
			});
			</script>
			
			
			<div class="cart_main">
				 <div class="container">
					
					 <div class="cart-items">
						 <h2>Sorry Your plate is empty.</h2>
						 
							<div class="cart">
								 <div class="cart-header2">									
									  <div class="cart-sec" style="color: red;padding: 10px;">
											There is no food left in your plate.
										   <div class="clearfix"></div>	
									  </div>
								  </div>	
							 </div>	
							  
							  
						 <div class="cart-total">
							 <div class="price-details" style="border-bottom: 0px solid;">
								 <h3>Price Details</h3>
								 <span>Total</span>
								 <span class="total tamount">$ 0</span>
								 <div class="clearfix"></div>
							 <div class="clearfix">&nbsp;</div>
							 
							 <a class="continue" href="<?php echo Yii::$app->homeUrl; ?>"> Find your food here..</a>

							</div>
							</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

	 <?php } ?>
	 
	
<br/>
<br/>
<br/>



	
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

	