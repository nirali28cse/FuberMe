
<?php

$order_items=null;
$order_items=$order_array['order_item'];

?>	


	<?php if(count($order_items)>0){ ?>
		 
			<div class="cart_main">
				 <div class="container">
					
					 <div class="cart-items">
						 <h2>Review Your Order</h2>

						<?php foreach($order_items as $value){ ?>
							<script>$(document).ready(function(c) {
									$('.close<?php echo $value['item_id']; ?>').on('click', function(c){
										$('.cart-header<?php echo $value['item_id']; ?>').fadeOut('slow', function(c){
										$('.cart-header<?php echo $value['item_id']; ?>').remove();
									});
									});	  
									});
							 </script>
							 <div class="cart-header<?php echo $value['item_id']; ?>">
								 <div class="close<?php echo $value['item_id']; ?>"> </div>
								  <div class="cart-sec">
										<div class="cart-item">
											 <img src="<?php echo $value['item_image']; ?>"/>
										</div>
									   <div class="cart-item-info">
											 <h3><?php echo $value['item_name']; ?><span><?php echo $value['item_cuisine_type']; ?><br/> <?php echo $value['item_ingredients']; ?> </span></h3>
											 <h4><span>$ </span><?php echo $value['item_price']; ?></h4>
									   </div>
									   <div class="clearfix"></div>
										<div class="delivery">
											 <p>Service Charges:: Rs.50.00</p>							
										</div>						
								  </div>
							  </div>	

						 <?php } ?>
 
					 </div>
					 
					 <div class="cart-total">

						 <div class="price-details">
							 <h3>Price Details</h3>
							 <span>Total</span>
							 <span class="total"><?php echo $order_array['total_amount']; ?></span>

							 <span>Paypel Charges (%)</span>
							 <span class="total"><?php echo $order_array['tax_in_percent']; ?></span>
							 <div class="clearfix"></div>				 
						 </div>	
						 <h4 class="last-price">TOTAL</h4>
						 <span class="total final"><?php echo $order_array['final_amount']; ?></span>
						 <div class="clearfix">&nbsp;</div>
						 
						 <a class="continue" href="<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/create">Continue to Order</a>

						</div>
				 </div>
			</div>

	 <?php }else{ ?>
			 
		<div class="container">

			 <div class="registration">
							<br/><br/><br/><br/>
							<center><h2>Sorry Your plat is empty. <br/> Find your food here..!! </h2></center>
							<br/>
							 <a class="continue" href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/conhome">Hungry</a>
				
				 <div class="clearfix"></div>
			 </div>
		</div>

	 <?php } ?>
	 
	