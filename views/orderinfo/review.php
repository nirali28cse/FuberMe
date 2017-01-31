
<?php
use yii\helpers\Html;
$order_items=null;
$order_items=$order_array['order_item'];

?>	


	<?php if(count($order_items)>0){ ?>
		 
			<div class="cart_main">
				 <div class="container">
					
					 <div class="cart-items">
						 <h2>Review Your Order</h2>

						<?php foreach($order_items as $value){ ?>
						

							 <div class="cart<?php echo $value['item_id']; ?>">
								 <div class="cart-header2">
									<a href="<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/review&itemid=<?php echo $value['item_id']; ?>&ditem=<?php echo $value['item_id']; ?>"> <div class="close2"></div></a>
									  <div class="cart-sec">
											<div class="cart-item">
												 <img src="<?php echo $value['item_image']; ?>"/>
											</div>
										   <div class="cart-item-info">
												 <h3><?php echo $value['item_name']; ?><span><?php echo $value['item_cuisine_type']; ?><br/> <?php echo $value['item_ingredients']; ?> </span></h3>
												 <h4><span>$ </span><?php echo $value['item_price']; ?></h4>
												 <?php
												 $item_chef_quantity=0;
												 $item_quantity_array=array();
												 $item_chef_quantity=$value['item_chef_quantity'];
												 for($count=1;$count<=$item_chef_quantity;$count++){
													$item_quantity_array[$count]=$count;	 
												 }
												 ?>
												 <span>
												 <?= Html::dropDownList('itemqty'.$value['item_id'], ['id'=>'itemqty'.$value['item_id']],
													 $item_quantity_array); ?>
												 </span>
										   </div>

										   <div class="clearfix"></div>
											<div class="delivery">
												 <p>Service Charges:: Rs.50.00</p>							
											</div>						
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
					var total_amount=myArray['total_amount'];
					var final_amount=myArray['final_amount'];
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

						 <div class="price-details">
							 <h3>Price Details</h3>
							 <span>Total</span>
							 <span class="total tamount"><?php echo $order_array['total_amount']; ?></span>

							 <span>Paypel Charges (%)</span>
							 <span class="total"><?php echo $order_array['tax_in_percent']; ?></span>
							 <div class="clearfix"></div>				 
						 </div>	
						 <h4 class="last-price">TOTAL</h4>
						 <span class="total final ttfinal"><?php echo $order_array['final_amount']; ?></span>
						 <div class="clearfix">&nbsp;</div>
						 
						 <a class="continue" href="<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/create">Continue to Order</a>

						</div>
				 </div>
			</div>
			
<script>

/* $(document).ready(function(c) {

	// Remove item from cart
	$('.close2').on('click', function(c){
			var item_id= $(this).attr("data-item_id");		
			$('.cart'+item_id).fadeOut('slow', function(c){
			$('.cart'+item_id).remove();
		});
	});	  

});	   */

		

 </script>

	 <?php }else{ 
	 		unset($_SESSION['order_array']);
			unset($_SESSION['master_chef']);
	 ?>
			 
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
	 
	
