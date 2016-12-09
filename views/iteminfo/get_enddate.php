<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\ItemInfo */
/* @var $form yii\widgets\ActiveForm */
?>



<style>
.datepicker table tr td.active:active:hover, .datepicker table tr td.active.highlighted:active:hover, .datepicker table tr td.active.active:hover, .datepicker table tr td.active.highlighted.active:hover, .datepicker table tr td.active:active:focus, .datepicker table tr td.active.highlighted:active:focus, .datepicker table tr td.active.active:focus, .datepicker table tr td.active.highlighted.active:focus, .datepicker table tr td.active:active.focus, .datepicker table tr td.active.highlighted:active.focus, .datepicker table tr td.active.active.focus, .datepicker table tr td.active.highlighted.active.focus{
    background-color:#38b662;
    border-color: #38b662;
}

.datepicker table tr td.active:active, .datepicker table tr td.active.highlighted:active, .datepicker table tr td.active.active, .datepicker table tr td.active.highlighted.active{
    background-color:#38b662;
    border-color: #38b662;
}
.input-group-addon{
	 background-color:#38b662;
	 border-color: green;
	 color:white;
}
</style>

<div class="item-info-form">

    <?php 

	$form = ActiveForm::begin(['action' => Yii::$app->homeUrl.'?r=iteminfo/update&id='.$model->id,'method' => 'post',]); ?>
	
	<div class="row">
		<div class="col-sm-12"  style="padding: 0;">
			<div class="col-sm-8" style="padding: 0;">
				<?php // $form->field($model, 'availability_to_date')->textInput(['maxlength' => true]) ?>
				
				<input type="hidden" name="ItemInfo[id]" value="<?php echo $model->id; ?>">
				
				<?= $form->field($model, 'availability_to_date')->label(false)->widget(
											DatePicker::className(), [
												// 'name' => 'ItemInfo[availability_to_date]', 
													'value' => date('d-M-Y'),
													'type' => DatePicker::TYPE_COMPONENT_APPEND,
													'options' => ['placeholder' => 'Select end date','style'=>'height: 50px;, font-size: 16px;'],
													'pluginOptions' => [
														'format' => 'dd-M-yyyy',
														'todayHighlight' => true,
														 'autoclose'=>true,
													]
											]
											);
				 ?>
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
		  </div>
		
	  </div>

	
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Done', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



