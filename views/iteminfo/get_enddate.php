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

</style>

<div class="item-info-form">

    <?php 

	$form = ActiveForm::begin(['action' => Yii::$app->homeUrl.'?r=iteminfo/makeitemlive&id='.$model->id.'&status=1','method' => 'post',]); ?>
	
	<div class="row">
		<div class="col-sm-12"  style="padding: 0;">
			<div class="col-sm-8" style="padding: 0;">
				<?php // $form->field($model, 'availability_to_date')->textInput(['maxlength' => true]) ?>
				
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
					'value'=>date('Y-m-d'),
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
				<?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>
			</div>
		  </div>
		
	  </div>

	
	
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save changes', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
	 </div>


    <?php ActiveForm::end(); ?>

</div>



