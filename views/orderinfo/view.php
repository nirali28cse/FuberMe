<style>
.invoicesuccess{
    color: #38b662;
    padding: 10px 0;
}
</style>


<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
			
			
				<?php if(isset($_GET['paysucess']) and $_GET['paysucess']==1){ ?>
						<div class="invoicesuccess">Your Payment Successfully Done.</div>
				<?php } ?>
				
				<a href="#"  onclick="goBack()" class="pull-right" style="color: #38b662;"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
    			<h2>Invoice</h2>
    			
				
				<h3 class="pull-right">Order # <?php echo $model->order_number; ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Bill To:</strong><br>
    					<?php echo $model->customer_name; ?><br>
    					<?php echo $model->customer_address; ?><br>
    					<?php echo $model->customer_city; ?>,<?php echo $model->customer_zip; ?><br>
    					
						Email : <?php echo $model->customer_email; ?>,<br>
						Mb No : <?php echo $model->customer_mobile_no; ?>
    				</address>
    			</div>

    		</div>
    		<div class="row">
    			<div class="col-xs-3">
    				<address>
    					<strong>Delivery Method:</strong><br>
    					<?php echo  Yii::$app->params['delivery_method'][$model->delivery_method]; ?><br>    					
    				</address> 
					
					<address>
					<?php if($model->delivery_method=='homedelivery'){ ?>
						<strong>Delivery Address:</strong><br>
    					<?php echo $model->customer_address; ?><br>
    					<?php echo $model->customer_city; ?>,<?php echo $model->customer_zip; ?><br>    										
					<?php } ?>
					<?php if($model->delivery_method=='pickup' and count($model->orderItemInfo)>0){ ?>
						<strong>PickUp Address:</strong><br>
    					<?php echo $model->orderItemInfo[0]->chefInfo->username; ?>,<br>  
    					<?php echo $model->orderItemInfo[0]->chefInfo->address;  ?>,<br>    										
    					<?php echo $model->orderItemInfo[0]->chefInfo->city;  ?>,<?php echo $model->orderItemInfo[0]->chefInfo->zipcode;  ?><br>    										
					<?php } ?>
    					
    				</address>
					
    			</div>  
				<div class="col-xs-3">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<?php echo  Yii::$app->params['payment_method'][$model->payment_method]; ?><br>    					
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					<?php echo $model->order_date_time; ?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<?php foreach($orderitems as $orderitem){ ?>    							
									<tr>
										<td><?php echo  $orderitem->itemInfo->name; ?></td>
										<td class="text-center">$ <?php echo  $orderitem->item_price; ?></td>
										<td class="text-center"><?php echo  $orderitem->item_qty; ?></td>
										<td class="text-right">$ <?php echo ($orderitem->item_price*$orderitem->item_qty); ?></td>
									</tr>
								<?php } ?>
								
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$ <?php echo $model->total_amount; ?></td>
    							</tr>		
								
								<?php if($model->tax_in_percent>0){ ?>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Tax(%)</strong></td>
    								<td class="thick-line text-right">$ <?php echo $model->tax_in_percent; ?></td>
    							</tr>
								<?php } ?>

    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">$ <?php echo $model->final_amount; ?></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>


<script>
function goBack() {
    window.history.back();
}
</script>