<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\users\models\Userdetail */
/* @var $form yii\widgets\ActiveForm */

?>

<!---->
<div class="container">

	 <div class="registration">
					<br/><br/><br/><br/>
					<center><h2>Payment failed.. <br/><br/>
					Please Try Again. 
					</h2>
					
					<?php 
					session_start();
					if(isset($_SESSION['order_array']['order_item']) and $_SESSION['order_array']['order_item']!=null){
							$item_id=0;
							$totla_item=0;
							$totla_item=count($_SESSION['order_array']['order_item']);
							foreach($_SESSION['order_array']['order_item'] as $item){
								$item_id=$item['item_id'];
								if($item_id>0) break;
							}
							
						?> 
					<a href="<?php echo Yii::$app->homeUrl; ?>?r=orderinfo/review&itemid=<?php echo $item_id; ?>"  class="continue">Here</a>
					<?php } ?>
					</center>
		
		 <div class="clearfix"></div>
	 </div>
</div>


