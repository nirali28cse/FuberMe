
<?php
use yii\helpers\Html;
use app\modules\users\models\Userdetail;


$order_items=null;
$order_items=$order_array['order_item'];
$customer_info=$order_array['customer_info'];
$master_chef_paypal_email='nirali28cse-facilitator-2@gmail.com';
$user_info = Userdetail::find()->where([ 'id'=>$master_chef,'status'=>1 ])->one();
if(count($user_info)>0){
$master_chef_paypal_email=$user_info->paypal_email;	
} 

if($master_chef_paypal_email==null){
	$master_chef_paypal_email='nirali28cse-facilitator-2@gmail.com';
}
/*  echo '<pre>';
print_r($order_array);
exit;
 */
 
?>	



<form id="paypalForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">

<?php 
/* <input type="hidden" name="business" value="nirali28cse-facilitator-2@gmail.com"> */
?>

<input type="hidden" name="business" value="<?php echo $master_chef_paypal_email; ?>">
<!--  customer info   -->
<input type="hidden" name="orderid" value="<?php echo $orderid; ?>">
<input type="hidden" name="userid" value="<?php echo $customer_info['customer_id']; ?>">
<input type="hidden" name="email" value="<?php echo $customer_info['customer_email']; ?>">
<input type="hidden" name="first_name" value="<?php echo $customer_info['customer_name']; ?>">
<!--  customer info   -->						


	<?php $counter=1; foreach($order_items as $value){ ?>	
			<!-- Begin First Item -->
	<input type="hidden" name="quantity_<?php echo $counter; ?>" value="<?php echo $value['item_qty']; ?>">
	<input type="hidden" name="item_name_<?php echo $counter; ?>" value="<?php echo $value['item_name']; ?>">
	<input type="hidden" name="item_id_<?php echo $counter; ?>" value="<?php echo $value['item_id']; ?>">
	<input type="hidden" name="item_number_<?php echo $counter; ?>" value="<?php echo $counter; ?>">
	<input type="hidden" name="amount_<?php echo $counter; ?>" value="<?php echo $value['item_price']; ?>">


	 <?php $counter++; } ?>
		 
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="tax_cart" value="<?php echo $order_array['tax_in_percent_amount']; ?>">



<input type="hidden" name="return" value="<?php  echo Yii::$app->homeUrl; ?>?r=orderinfo/paypalorderSuccess">
<input type="hidden" name="cancel_return" value="<?php  echo Yii::$app->homeUrl; ?>?r=orderinfo/paypalorderfailer">


 
	<br/><br/><br/><br/>
	<center><h2>Please Wait...<br/><br/>
	Your Order is in process..!
	<br/><br/><br/>
	</h2></center>

 <img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/loader.gif'); ?>" style="display: block;margin: auto;"/>

</form>


 <script>
   document.getElementById('paypalForm').submit(); // SUBMIT FORM
  </script>