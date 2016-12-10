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

			 <div class="registration_form">
			 <!-- Form -->

				<div class="userdetail-form signin" >
				
				
				
					<h2>Please Contact to Admin</h2>
					
					<span><a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;tf=1&amp;to=info@fuberme.com">info@fuberme.com</a></span>
 
					<?php /* $form = ActiveForm::begin(); ?>
					
					Username					
					<input type="text" class="form-control" name="username">
					<br/>
					<span style="color:red;"><?php if($username_errormesg!=null) echo $username_errormesg; ?></span>
					
					New Password
					<input type="password" class="form-control" name="new_password">
					<br/>
					Verify Password
					<input type="password" class="form-control" name="reenter_password">
					<span style="color:red;"><?php if($password_errormesg!=null) echo $password_errormesg; ?></span>
 
					<br/>
					<div>
						<input type="submit" value="Submit" id="register-submit">
					</div>
					
					<br/>
					<p>Go Back to 
					<a href="<?php echo  Yii::$app->getHomeUrl(); ?>"  class="green">Home</a>
					</p>



					<?php ActiveForm::end(); */ ?>

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
			 <img src="../web/fuberme/images/forgotpass.jpg" alt="" style="float: right;" />
			 
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>


