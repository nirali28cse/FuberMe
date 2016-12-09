<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use kartik\widgets\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\ItemInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-info-form">

    <?php 	
	$form = ActiveForm::begin([
		'options'=>['enctype'=>'multipart/form-data'] // important
	]); ?>
	
	<div class="row">
		<div class="col-sm-6">	
		    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
		</div>	
		<div class="col-sm-6">	
		    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
		</div>
	 </div>

	<br/>
	
	
	<div class="row">
		<div class="col-sm-6">	
		<?php $item_cuisine_type_info_id = yii\helpers\ArrayHelper::map(app\models\CuisineTypeInfo::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
			<?= $form->field($model, 'item_cuisine_type_info_id')
				->dropDownList(
					$item_cuisine_type_info_id,           // Flat array ('id'=>'label')
					['prompt'=>'Select Cuisine']    // options
				);
			?>	
		</div>	
		<div class="col-sm-6">	
			<?php $item_category_info_id = yii\helpers\ArrayHelper::map(app\models\ItemCategoryInfo::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
			<?= $form->field($model, 'item_category_info_id')
				->dropDownList(
					$item_category_info_id,           // Flat array ('id'=>'label')
					['prompt'=>'Select Category']    // options
				);
			?>	
		</div>
	 </div>
	

	<br/>


	<div class="row">
		<div class="col-sm-6">	
			<?= $form->field($model, 'delivery_method')
				->dropDownList(
					Yii::$app->params['delivery_method'],           // Flat array ('id'=>'label')
					['prompt'=>'Select Delivery Method']    // options
				);
			?>
		</div>	
		<div class="col-sm-6">	
		Heads UP Time	
		<?php // $form->field($model, 'availability_to_time')->textInput(['maxlength' => true]) ?>
		<?=  TimePicker::widget([
			'name' => 'ItemInfo[head_up_time]', 
			'value' => '11:00',
			'pluginOptions' => [
				'showSeconds' => false,
				'minuteStep' => 30,
				'todayHighlight' => true,
				'showMeridian' => false,
				 'autoclose'=>true,
				
			]
		]); ?>
		</div>
	 </div>


	<br/>

	  <div class="row">
		<div class="col-sm-6">
			Availability Start On	
		</div>
	  </div>
	<div class="row">
		<div class="col-sm-6">	
			<?php // $form->field($model, 'availability_from_date')->textInput(['maxlength' => true]) ?>
				<?=  DatePicker::widget([
					'name' => 'ItemInfo[availability_from_date]', 
					'type' => DatePicker::TYPE_COMPONENT_APPEND,
					'value' => date('d-M-Y'),
					'options' => ['placeholder' => 'Select issue date ...'],
					'pluginOptions' => [
						'format' => 'dd-M-yyyy',
						'todayHighlight' => true,
						 'autoclose'=>true,
					]
				]);
				?>
		</div>
		<div class="col-sm-6">	
			<?php // $form->field($model, 'availability_from_time')->textInput(['maxlength' => true]) ?>
			<?=  TimePicker::widget([
				'name' => 'ItemInfo[availability_from_time]', 
				'value' => '11:00',
				'pluginOptions' => [
					'showSeconds' => false,
					'minuteStep' => 30,
					'todayHighlight' => true,
					'showMeridian' => false,
					 'autoclose'=>true,
				]
			]); ?>
		</div>
	  </div>

	<br/>
	

	  <div class="row">
		<div class="col-sm-6">
			Availability End On	
		</div>
	  </div>
	  <div class="row">
		<div class="col-sm-6">
			<?php // $form->field($model, 'availability_to_date')->textInput(['maxlength' => true]) ?>
			<?=  DatePicker::widget([
				'name' => 'ItemInfo[availability_to_date]', 
				'value' => date('d-M-Y'),
				'type' => DatePicker::TYPE_COMPONENT_APPEND,
				'options' => ['placeholder' => 'Select issue date ...'],
				'pluginOptions' => [
					'format' => 'dd-M-yyyy',
					'todayHighlight' => true,
					 'autoclose'=>true,
				]
			]); ?>
		</div>
		<div class="col-sm-6">	
			<?php // $form->field($model, 'availability_to_time')->textInput(['maxlength' => true]) ?>
			<?=  TimePicker::widget([
				'name' => 'ItemInfo[availability_to_time]', 
				'value' => '11:00',
				'pluginOptions' => [
					'showSeconds' => false,
					'minuteStep' => 30,
					'todayHighlight' => true,
					'showMeridian' => false,
					 'autoclose'=>true,
					
				]
			]); ?>	
		</div>
	  </div>


	<br/>
	
	
    <?= $form->field($model, 'ingredients')->textarea(['rows' => 6,'class'=>"col-sm-12"]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6,'class'=>"col-sm-12"]) ?>
	
	<?php $images_array=null; ?>
    <?=	
	
	
	    $form->field($model, 'image')->widget(FileInput::classname(), [
					'options' => ['accept' => 'image/*'],
					'pluginOptions'=>[
						'allowedFileExtensions'=>['jpg', 'gif', 'png', 'jpeg'],
						'showUpload' => false,

					],
				]);	
				
				
		/* $form->field($model, 'image')->widget(FileInput::classname(), [
				'options' => [
							'accept' => 'image/*',
							 'multiple' => false,
							 
							],
				'pluginOptions'=>[
						'allowedFileExtensions'=>['jpg', 'gif', 'png', 'jpeg'],
						'uploadExtraData' => [
						//	'item_info_id' => $_GET['iteminfoid'],
						],
						'initialPreview' =>$images_array,
					//	'overwriteInitial' => false,
						'maxFileCount' =>5,
						'showPreview' => true,
						'showCaption' => true,
						'showRemove' => true,
						'showUpload' => true,
					],
				
			]); */
		
		?>

	
	
	<?php // $form->field($model, 'status')->radioList([1 => 'Active', 0 => 'InActive']); ?> 
		

	<br/>
	

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
