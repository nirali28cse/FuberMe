<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use kartik\time\TimePicker;
// use kartik\date\DatePicker;
// use kartik\widgets\FileInput;
use yii\helpers\Url;
// use sjaakp\illustrated\Uploader;
// use yii\jui\DatePicker;



/* @var $this yii\web\View */
/* @var $model app\models\ItemInfo */
/* @var $form yii\widgets\ActiveForm */


$this->registerJsFile(Url::to('@web/fuberme/js/jquery.min.js'),array(
		'position' => \yii\web\View::POS_HEAD
	));
$this->registerJsFile(Url::to('@web/fuberme/js/jquery.imgareaselect.pack.js'),array(
		'position' => \yii\web\View::POS_HEAD
	));
$this->registerJsFile(Url::to('@web/fuberme/js/script.js'),array(
		'position' => \yii\web\View::POS_HEAD
	));

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

</style>

<div class="item-info-form">

    <?php 

	$form = ActiveForm::begin([
		'options'=>['enctype'=>'multipart/form-data'] // important
	]); 
	
	?>
	
	<div class="row">
		<div class="col-sm-6">	
		    <?= $form->field($model, 'name')->textInput(['maxlength' => true])  ?>
		</div>	
		<div class="col-sm-3">	
		    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-sm-3">	
		    <?= $form->field($model, 'quantity')->textInput(['type' =>'number','min' =>'0','maxlength' => true]) ?>
		</div>
	 </div>

	
	<div class="row">
		
		<?php 
/* 	<div class="col-sm-6">		$item_cuisine_type_info_id = yii\helpers\ArrayHelper::map(app\models\CuisineTypeInfo::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
			<?= $form->field($model, 'item_cuisine_type_info_id')
				->dropDownList(
					$item_cuisine_type_info_id,           // Flat array ('id'=>'label')
					['prompt'=>'Select Cuisine']    // options
				); </div>	 */
			?>	
		<div class="col-sm-6">	
			<?php $item_dietary_preference = yii\helpers\ArrayHelper::map(app\models\DietaryPreference::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
			<?= $form->field($model, 'item_dietary_preference')
				->dropDownList(
					$item_dietary_preference,           // Flat array ('id'=>'label')
					['prompt'=>'Select Dietary Preference']    // options
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

	 


	<div class="row">
		<div class="col-sm-6">	
			<?php /*  $form->field($model, 'delivery_method')
				->dropDownList(
					Yii::$app->params['delivery_method'],           // Flat array ('id'=>'label')
					['prompt'=>'Select Delivery Method']    // options
				); */
				
			$item_cuisine_type_info_id = yii\helpers\ArrayHelper::map(app\models\CuisineTypeInfo::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
			<?= $form->field($model, 'item_cuisine_type_info_id')
				->dropDownList(
					$item_cuisine_type_info_id,           // Flat array ('id'=>'label')
					['prompt'=>'Select Cuisine']    // options
				);
			?>
		</div>	
		<div class="col-sm-6">	

		<?php // $form->field($model, 'availability_to_time')->textInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'head_up_time')
			->dropDownList(
				Yii::$app->params['head_up_time'],           // Flat array ('id'=>'label')
				['prompt'=>'Select Time']    // options
			);
		?>
		</div>
	 </div>



	<div class="row">
		<div class="col-sm-6">	
			<div class="col-sm-6" style="padding: 0;">
			<?php //echo  $form->field($model, 'availability_from_date')->textInput(['maxlength' => true]) ?>


				<?= $form->field($model, 'availability_from_date')->widget(\yii\jui\DatePicker::classname(), [
					'dateFormat' => 'php:Y-m-d',
					'value'=>Yii::$app->params['today_date'],
					'options' => ['placeholder' => 'Select Start date',
					'style'=>'height: 50px;width: 100%;padding: 10px;font-size: 16px;'],
					'clientOptions' => [
					 //   'autoclose' => true,     
					],
					'clientOptions' => [
						'minDate'=>'0', 
					],
				]) ?>

				<?php /*  $form->field($model, 'availability_from_date')->widget(
											DatePicker::className(), [
														//	'name' => 'ItemInfo[availability_to_date]', 
													
													'type' => DatePicker::TYPE_COMPONENT_APPEND,
													'options' => ['placeholder' => 'Select start date','style'=>'height: 50px;, font-size: 16px;'],
													'pluginOptions' => [
														'format' => 'yyyy-mm-dd',
														'todayHighlight' => true,
														'autoclose'=>true,
														'startDate'=> date('Y-m-d'),														 
													],
																
											]
											); */
				 ?>

			</div>
			<div class="col-sm-6" style="padding: 0;">	
				<?php // $form->field($model, 'availability_from_time')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'availability_from_time')->label(false)
					->dropDownList(
						Yii::$app->params['time_piker'],           // Flat array ('id'=>'label')
						['prompt'=>'Select Time','style'=>'height: 50px;margin-top: 22px;']    // options
					);
				?>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="col-sm-6" style="padding: 0;">
				<?php // echo $form->field($model, 'availability_to_date')->textInput(['maxlength' => true]) ?>


			<?= $form->field($model, 'availability_to_date')->widget(\yii\jui\DatePicker::classname(), [
				'dateFormat' => 'php:Y-m-d',
				'value'=>Yii::$app->params['today_date'],
				'options' => ['placeholder' => 'Select end date',
				'style'=>'height: 50px;width: 100%;padding: 10px;font-size: 16px;'],
				'clientOptions' => [
				 //   'autoclose' => true,   
					'minDate'=>'0', 				 
				],
			]) ?>



				<?php  /* $form->field($model, 'availability_to_date')->widget(
											DatePicker::className(), [
												// 'name' => 'ItemInfo[availability_to_date]', 
													'value' => date('Y-m-d'),
													'type' => DatePicker::TYPE_COMPONENT_APPEND,
													'options' => ['placeholder' => 'Select end date','style'=>'height: 50px;, font-size: 16px;'],
													'pluginOptions' => [
														'format' => 'yyyy-mm-dd',
														'todayHighlight' => true,
														'autoclose'=>true,
														'startDate'=> date('Y-m-d'),
													]
											]
											); */
				 ?>
			</div>
			<div class="col-sm-6" style="padding: 0;">
				<?php // $form->field($model, 'availability_to_time')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'availability_to_time')->label(false)
					->dropDownList(
						Yii::$app->params['time_piker'],           // Flat array ('id'=>'label')
						['prompt'=>'Select Time','style'=>'height: 50px;margin-top: 22px;']    // options
					);
				?>	
			</div>
		  </div>
		
	  </div>

	
	<div class="col-sm-12">	
       <?= $form->field($model, 'ingredients')->textarea(['rows' => 6 ,'maxlength' => 500 ]) ?>
	 </div>

	 <div class="col-sm-12">	
       <?= $form->field($model, 'description')->textarea(['rows' => 6,'maxlength' => 500]) ?>
	 </div>
   
	 <div class="col-sm-12">	
	<?php
		$images_array=''; 
		$folder_name='item_images';
		$user_id=Yii::$app->user->id;
		if($model->image!=null){
			$images_array=yii\helpers\Url::to('@web/fuberme/').$user_id.'/'.$folder_name.'/'.$model->image;			
			echo '<img id="uploadPreview" src="'.$images_array.'" style="max-width: 700px;" />';
		}else{
			
		echo '<img id="uploadPreview" style="max-width: 700px;" />';	
		}
		

		?>
		
		
		
		<br/>
	<!-- image uploading form -->

		<input id="uploadImage" type="file" accept="image/*" name="image" />
		

		<!-- hidden inputs -->
		<input type="hidden" id="x" name="x" />
		<input type="hidden" id="y" name="y" />
		<input type="hidden" id="w" name="w" />
		<input type="hidden" id="h" name="h" />

	
	 </div>
   


	<br/>
	

    <div class="form-group">
        <a href="<?php echo Yii::$app->homeUrl; ?>?r=iteminfo/index" style="margin-left: 15px;" class="btn btn-success">Cancel</a>
		
		<?= Html::submitButton($model->isNewRecord ? 'Add Item' : 'Update Item', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
		
    </div>

    <?php ActiveForm::end(); ?>

</div>
