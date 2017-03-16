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
			 <h2>Profile Edit</h2>
		
			 <div class="registration_form">
			 <!-- Form -->

				<div class="userdetail-form signin" >

					<?php $form = ActiveForm::begin(['id'=>'registrationform']); ?>

					<?= $form->field($model, 'email_id')->textInput(['maxlength' => true, 'disabled'=>'true']) ?>
					
					<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
		
					<?= $form->field($model, 'mobile_number')->hint('e.g. 5085551234',['class'=>'green'])->textInput(['minlength' => '10','maxlength' => '10']) ?>
					
					
					<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>	

					<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
					
						
					<?php $usa_state = yii\helpers\ArrayHelper::map(app\models\UsaState::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
					<?= $form->field($model, 'state')
						->dropDownList(
							$usa_state,           // Flat array ('id'=>'label')
							['prompt'=>'Select state']    // options
						);
					?>

					
					<?= $form->field($model, 'zipcode')->hint('e.g. 01581',['class'=>'green'])->textInput(['minlength' => '5','maxlength' => '5']) ?>
					
				
					<?php if($model->user_type!=1){ ?>
					
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

					<?php } ?>
	
					<?php /* $model->is_aggree_with_terms_condition = true; 

					 echo $form->field($model, 'is_aggree_with_terms_condition')->checkbox(['checked'=>true,'uncheck'=>'0','value'=>'1']);  */  ?>
					
					<div>
						<input type="submit" value="Update" id="register-submit">
					</div>
					
					<br/>



					<?php ActiveForm::end(); ?>

				</div>
				<!-- /Form -->
			 </div>
		 </div>
		 <div class="registration_left">

			 <img src="<?php echo  yii\helpers\Url::to('@web/fuberme/images/profile_settings.png'); ?>"alt="" style="width:100%;" />
			 
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>

<script>
var paymentmethod1=$('#userdetail-payment_method').val();
if(paymentmethod1=='paypal'){	
	$('.field-userdetail-paypal_email').show();
}else{
	$('.field-userdetail-paypal_email').hide();
}	

$("body").on("change","#userdetail-payment_method",function(){
	var paymentmethod=$(this).val();				
	if(paymentmethod=='paypal'){
		$('.field-userdetail-paypal_email').show();
	}else{
		$('.field-userdetail-paypal_email').hide();
	}
});	



</script>
