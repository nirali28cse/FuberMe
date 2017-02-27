
 <?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<!---->

	 <div class="container">
	 
<?php

     $reset_password=Yii::$app->session->get('reset_password');
	 if(!is_null($reset_password)){
		 echo $reset_password;
	 }
?>	
		 <h2>Reset Password</h2>
		 
		 <div class="col-md-6 log">		 
				
				 <form method="post" name="resetpassword">
					 <input type="password" name="new_password" placeholder="New Password" />	
						<div class="clearfix">&nbsp;</div>
					 <input type="password" name="reenter_password" placeholder="Reset Password" />	
					 <div class="clearfix">&nbsp;</div>
					 <input type="submit" value="Reset Password">
					 <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					  
				 </form>					 
		 </div>

		 <div class="clearfix"></div>
	 </div>


<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
