
 <?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<!---->

	 <div class="container">
	 
<?php

     $forget_password=Yii::$app->session->get('forget_password');
	 if(!is_null($forget_password)){
		 echo $forget_password;
	 }
?>	
		 <h2>Forgot Password?</h2>
		 <div class="col-md-6 log">			 
				
				  <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true]); ?>
	
						<?= $form
							->field($model, 'email_id')
							->label(false)
							->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
						
					 <input type="submit" value="Submit">
					 
				 <?php ActiveForm::end(); ?>		 
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
