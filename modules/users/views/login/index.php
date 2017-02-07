
 <?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<!---->

	 <div class="container">
	 
<?php

     $verify_email=Yii::$app->session->get('verify_email');
	 if(!is_null($verify_email)){
		 echo $verify_email;
	 }
?>	
		 <h2>Login</h2>
		 <div class="col-md-6 log">			 
				
				  <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true]); ?>
	
						<?= $form
							->field($model, 'email_id')
							->label(false)
							->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
						<?= $form
							->field($model, 'password')
							->label(false)
							->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>			
					 <input type="submit" value="Login">
					  <a href="<?php echo  Yii::$app->getHomeUrl(); ?>?r=users/forgotpassword">Forgot Password ?</a>
				 <?php ActiveForm::end(); ?>		 
		 </div>
		 <?php
/* 		  <div class="col-md-6 login-right">
			  	<h3>NEW CHEF REGISTRATION</h3>
				<p>
					Home based chefs who want to sell their home-made food to foodies without leaving their home! Can’t get easier and the best part is doing it when you feel like and get rewarded $$$
				</p>
				<a class="acount-btn" href="<?php echo  Yii::$app->getHomeUrl(); ?>?r=users/registration">Create an Account</a>
		 </div> */
		 ?>
		 
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

 <?php

/*
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

/*
$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Smart</b>IYE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

        <!--
		<div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
                using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
                in using Google+</a>
        </div>
         /.social-auth-links 

        <a href="#">I forgot my password</a>-->
		<br>
        <a href="<?php echo  Yii::$app->getHomeUrl(); ?>?r=users/registration" class="text-center">Register a new membership</a>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

*/
?>