<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\users\models\Userdetail */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
.registration_form div {
    padding: 0; 
}
</style>

<!---->
<div class="container">

	 <div class="registration">
		 <div class="registration_left">
			 <h2>SignUP</h2>
		
			 <div class="registration_form">
			 <!-- Form -->

				<div class="userdetail-form signin" >

					<?php $form = ActiveForm::begin(['id'=>'registrationform']); ?>

					<?= $form->field($model, 'email_id')->textInput(['maxlength' => true]) ?>
			
					<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
						
					<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
		
					<?= $form->field($model, 'mobile_number')->textInput(['maxlength' => '12']) ?>
					
					
					<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>	

					<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
					
						
					<?php $usa_state = yii\helpers\ArrayHelper::map(app\models\UsaState::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
					<?= $form->field($model, 'state')
						->dropDownList(
							$usa_state,           // Flat array ('id'=>'label')
							['prompt'=>'Select state']    // options
						);
					?>

					
					<?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>
					

					
					<?= $form->field($model, 'delivery_method')
						->dropDownList(
							Yii::$app->params['delivery_method'],           // Flat array ('id'=>'label')
							['prompt'=>'Select Delivery Method']    // options
						);
					?>
					

					<?= $form->field($model, 'payment_method')
						->dropDownList(
							Yii::$app->params['payment_method'],           // Flat array ('id'=>'label')
							['prompt'=>'Select Payment Method']    // options
						);
					?>

					<?=  $form->field($model, 'paypal_email')->textInput(['maxlength' => true]) ?>


					<?php // $form->field($model, 'create_at')->textInput() ?>

					<?php // $form->field($model, 'lastvisit_at')->textInput() ?>

					<?php // $form->field($model, 'superuser')->textInput() ?>

					<?php // $form->field($model, 'status')->textInput() ?>

					<?php $model->is_aggree_with_terms_condition = true; 

					 echo $form->field($model, 'is_aggree_with_terms_condition')->checkbox(['checked'=>true,'uncheck'=>'0','value'=>'1']); ?>
					
					<div>
						<input type="submit" value="create an account" id="register-submit">
					</div>
					
					<br/>
					<p>Go Back to
					<a href="<?php echo  Yii::$app->getHomeUrl(); ?>?r=users/login" class="green">Login</a> | 
					<a href="<?php echo  Yii::$app->getHomeUrl(); ?>"  class="green">Home</a>
					</p>



					<?php ActiveForm::end(); ?>

				</div>
				<!-- /Form -->
			 </div>
		 </div>
		 <div class="registration_left">
		  <?php
/* 			 <h2>existing user</h2>
			 <div class="registration_form">
			 <!-- Form -->
				  <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
					 <h5>User Name:</h5>	
						<?= $form
							->field($model, 'username')
							->label(false)
							->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
					 <h5>Password:</h5>
						<?= $form
							->field($model, 'password')
							->label(false)
							->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>			
					 <input type="submit" value="Login">
					 <br/><br/>
					  <a href="#">Forgot Password ?</a>
				 <?php ActiveForm::end(); ?>	
			 <!-- /Form -->
			 </div> */
			 ?>
			 <img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/chef.jpg'); ?>"alt="" style="width:100%;" />
			 
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>

<script>

$('.field-userdetail-paypal_email').hide();
$("body").on("change","#userdetail-payment_method",function(){
	var paymentmethod=$(this).val();				
	if(paymentmethod=='paypal'){
		$('.field-userdetail-paypal_email').show();
	}else{
		$('.field-userdetail-paypal_email').hide();
	}
});	



</script>
