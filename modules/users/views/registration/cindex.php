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
			 <h2>Still Cooking</h2>
		
			 <div class="registration_form">
			 <!-- Form -->

				<div class="userdetail-form signin" >
					
					<p>
					  We will let you know as soon as we are ready to take your order
					</p>
					<br/>
					<?php $form = ActiveForm::begin(); ?>

					<?= $form->field($model, 'email_id')->label(false)->textInput(['Placeholder'=>'Enter Your Email','maxlength' => true]) ?>
					

					<div>
						<input type="submit" value="Subscribe" id="register-submit">
					</div>
					
					<br/>
					<p>Go Back to
					<!-- <a href="<?php // echo  Yii::$app->getHomeUrl(); ?>?r=users/login/clogin" class="green">Login</a> |  -->
					| <a href="<?php echo  Yii::$app->getHomeUrl(); ?>"  class="green">Home</a>
					</p>



					<?php ActiveForm::end(); ?>
					
					<br/>

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

					
					<br/>
					
			 <img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/foody.png'); ?>"alt="" style="float: right;" />
			 
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>

<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
