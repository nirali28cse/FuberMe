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
			 <h2>new user? <span> create an account </span></h2>
		
			 <div class="registration_form">
			 <!-- Form -->

				<div class="userdetail-form signin" >

					<?php $form = ActiveForm::begin(); ?>

					<?= $form->field($model, 'email_id')->textInput(['maxlength' => true]) ?>
					

					<div>
						<input type="submit" value="create an account" id="register-submit">
					</div>
					
					<br/>
					<p>Go Back to
					<!-- <a href="<?php // echo  Yii::$app->getHomeUrl(); ?>?r=users/login/clogin" class="green">Login</a> |  -->
					| <a href="<?php echo  Yii::$app->getHomeUrl(); ?>"  class="green">Home</a>
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

		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>


