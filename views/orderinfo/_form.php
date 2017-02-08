<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['value' =>$order_array['customer_info']['customer_name'],'maxlength' => true]) ?>

    <?= $form->field($model, 'customer_email')->textInput(['value' =>$order_array['customer_info']['customer_email'],'maxlength' => true]) ?>

    <?= $form->field($model, 'customer_mobile_no')->textInput(['value' =>$order_array['customer_info']['customer_mobile_no'],'maxlength' => true]) ?>

    <?= $form->field($model, 'customer_address')->textarea(['value' =>$order_array['customer_info']['customer_address'],'rows' => 6]) ?>

    <?= $form->field($model, 'customer_city')->textInput(['value' =>$order_array['customer_info']['customer_city'],'maxlength' => true]) ?>


	<?php $usa_state = yii\helpers\ArrayHelper::map(app\models\UsaState::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
	<?= $form->field($model, 'customer_state')
		->dropDownList(
			$usa_state,           // Flat array ('id'=>'label')
			['value'=>$order_array['customer_info']['customer_state'],
			'prompt'=>'Select state']    // options
		);
	?>
					
					
    <?= $form->field($model, 'customer_zip')->textInput(['value' =>$order_array['customer_info']['customer_zip'],'maxlength' => true]) ?>
	
	
	<?php
	
	$payment_method=array();
	
	if($order_array['payment_method']=='paypal'){
		$payment_method=array('paypal'=>'PayPal');
	}	
	if($order_array['payment_method']=='cod'){
		$payment_method=array('cod'=>'Cash On Delivery');
	}
	
	
	$delivery_method=array();
	$delivery_method_value=null;
	if($order_array['delivery_method']=='pickup'){
		$delivery_method= array('pickup'=>'Pickup');
		$delivery_method_value='pickup';
	}	
	if($order_array['delivery_method']=='homedelivery'){
		$delivery_method= array('homedelivery'=>'Home Delivery');
		$delivery_method_value='homedelivery';
	}
	if($order_array['delivery_method']=='both'){
		$delivery_method= array('pickup'=>'Pickup','homedelivery'=>'Home Delivery');
	//	$delivery_method_value='pickup';
	}
	?>
	
	
	<?= $form->field($model, 'delivery_method')
		->dropDownList(
			$delivery_method,           // Flat array ('id'=>'label')
			['value'=>$delivery_method_value,			
			'prompt'=>'Select Delivery Method']    // options
		);
	?>
	

	<?= $form->field($model, 'payment_method')
		->dropDownList(
			$payment_method,           // Flat array ('id'=>'label')
			['value'=>$order_array['payment_method'],
			'prompt'=>'Select Payment Method']    // options
		);
	?>


	
    <?= $form->field($model, 'order_notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Place Order' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
