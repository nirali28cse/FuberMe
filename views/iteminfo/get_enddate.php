<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use kartik\date\DatePicker;

?>



<style>

.ui-widget-content {
    background: rgb(56, 182, 98);
    color: rgb(255, 255, 255);
}

.ui-widget-header {
    background: #ffffff;
    color: #38b662/*{fcHeader}*/;
}

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: 0px solid #38b662/*{borderColorDefault}*/;
    background: rgb(255, 255, 255);
    font-weight: normal/*{fwDefault}*/;
    color: rgb(56, 182, 98)/*{fcDefault}*/;
    border-radius: 0;
    outline: none;
    width: 40px;
    height: initial;
    cursor: pointer;
}

.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
    background: #38b662;
}

.ui-widget-content {
    background: rgba(56, 182, 98, 0.54);
}

#display_error{
	color: red;
    font-size: 15px;
    padding-bottom: 10px;
}
	

</style>

<div id="display_error"></div>


<div class="item-info-form">

    <?php 

	$form = ActiveForm::begin([
		'action' => Yii::$app->homeUrl.'?r=iteminfo/makeitemlive&id='.$model->id.'&status=1',
		'method' => 'post',
		'id' => 'live-form',
		'enableAjaxValidation' => false,
		'enableClientValidation' => false,
		'options' => ['onsubmit' => 'return validateform1()']
	]); ?>
	
	<div class="row">
		<div class="col-sm-12"  style="padding: 0;">
			<div class="col-sm-8" style="padding: 0;">
				<?php  // $form->field($model, 'availability_to_date')->textInput(['maxlength' => true]) ?>
				
				<input type="hidden" name="ItemInfo[availability_from_date]" value="<?php echo $model->availability_from_date; ?>">
				<input type="hidden" name="ItemInfo[id]" value="<?php echo $model->id; ?>">
				
				<?php /* $form->field($model, 'availability_to_date')->label(false)->widget(
											DatePicker::className(), [
												// 'name' => 'ItemInfo[availability_to_date]', 
													
													'type' => DatePicker::TYPE_COMPONENT_APPEND,
													'options' => ['value' => date('Y-m-d'),'placeholder' => 'Select end date','style'=>'height: 50px;, font-size: 16px;'],
													'pluginOptions' => [
														'format' => 'yyyy-mm-dd',
														'todayHighlight' => true,
														'autoclose'=>true,
														'startDate'=> date('Y-m-d'),
													]
											]
											); */
				 ?>
				<?= $form->field($model, 'availability_to_date')->label(false)->widget(\yii\jui\DatePicker::classname(), [
					'dateFormat' => 'php:Y-m-d',
					'value'=>Yii::$app->params['today_date'],
					'options' => ['placeholder' => 'Select end date',
					'style'=>'height: 50px;width: 100%;padding: 10px;font-size: 16px;'],
					'clientOptions' => [
						'minDate'=>'0', 
					],
				]) ?>
				 
				 
			</div>
			<div class="col-sm-4" style="padding: 0;">
				<?php // $form->field($model, 'availability_to_time')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'availability_to_time')->label(false)
					->dropDownList(
						Yii::$app->params['time_piker'],           // Flat array ('id'=>'label')
						['prompt'=>'Select Time','style'=>'height: 50px;']    // options
					);
				?>	
			</div>
			
			<div class="col-sm-12" style="padding: 0;">	
				<?= $form->field($model, 'quantity')->textInput(['type' =>'number','maxlength' => true]) ?>
			</div>
		  </div>
		
	  </div>

	
	
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save changes', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
	 </div>


    <?php ActiveForm::end(); ?>

</div>

 <script type="text/javascript"> 
 function validateform1(){ 

	var availability_from_date=$('input[name="ItemInfo[availability_from_date]"]').val(); 
	var availability_to_date=$('input[name="ItemInfo[availability_to_date]"]').val(); 
	var availability_to_time = $('select#iteminfo-availability_to_time option:selected').val();
	var quantity=$('input[name="ItemInfo[quantity]"]').val(); 
	var display_error='';
	
	function isInt(x) {
		return !isNaN(x) && eval(x).toString().length == parseInt(eval(x)).toString().length
	}

	function isFloat(x) {
		return !isNaN(x) && !isInt(eval(x)) && x.toString().length > 0;
	}


	if ((new Date(availability_from_date).getTime()) > (new Date(availability_to_date).getTime())) {
		display_error+='Select End Date grater then start date.<br/>';
	}
	
	if(quantity==0 || quantity==null){
		display_error+='Select Quantity.<br/>';	
	}
	
	if(isFloat(quantity)){
		display_error+='Quantity must be in number.<br/>';	
	}
	
	var d = new Date(); // for now
	var current_hour=d.getHours(); // => 9
	var current_miniute=d.getMinutes(); // =>  30
	
	  var currentDate_Year  = new Date().getFullYear();
	  var currentDate_Month = new Date().getMonth()+1;
	  var currentDate_Date = new Date().getDate();
	  if(currentDate_Date<10) {
		currentDate_Date='0'+currentDate_Date;
	  } 
	  if(currentDate_Month<10) {
		currentDate_Month='0'+currentDate_Month;
	  } 
	  if(current_miniute<10) {
		current_miniute='0'+current_miniute;
	  } 
	  var currentDate_Day =currentDate_Year+'-'+currentDate_Month+'-'+currentDate_Date;
	
	var currentDate_Day_time='';
	var currentDate_Day_time2='';
	
	if ((new Date(availability_to_date).getTime()) == (new Date(currentDate_Day).getTime())) {
		currentDate_Day_time=currentDate_Day+' '+current_hour+':'+current_miniute;
		currentDate_Day_time2=currentDate_Day+' '+availability_to_time;
		if ((new Date(currentDate_Day_time).getTime()) >= (new Date(currentDate_Day_time2).getTime())){
			display_error+='Select time in future.<br/>';	
		}
	}

	if(display_error=='' || display_error==null){
		
	}else{
		$('#display_error').html(display_error);
		return false; 	
	}	
   
 }
</script>