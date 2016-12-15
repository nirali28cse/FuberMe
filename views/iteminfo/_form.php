<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use sjaakp\illustrated\Uploader;


/* @var $this yii\web\View */
/* @var $model app\models\ItemInfo */
/* @var $form yii\widgets\ActiveForm */


$this->registerJsFile('@bower/fuberme/js/jquery.min.js',array(
		'position' => \yii\web\View::POS_HEAD
	));
$this->registerJsFile('@bower/fuberme/js/jquery.imgareaselect.pack.js',array(
		'position' => \yii\web\View::POS_HEAD
	));
$this->registerJsFile('@bower/fuberme/js/script.js',array(
		'position' => \yii\web\View::POS_HEAD
	));
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

	$form = ActiveForm::begin([
		'options'=>['enctype'=>'multipart/form-data'] // important
	]); 
	
	?>
	
	<div class="row">
		<div class="col-sm-6">	
		    <?= $form->field($model, 'name')->textInput(['maxlength' => true])  ?>
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
			<?php // $form->field($model, 'availability_from_date')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'availability_from_date')->widget(
											DatePicker::className(), [
														//	'name' => 'ItemInfo[availability_to_date]', 
													
													'type' => DatePicker::TYPE_COMPONENT_APPEND,
													'options' => ['placeholder' => 'Select start date','style'=>'height: 50px;, font-size: 16px;'],
													'pluginOptions' => [
														'format' => 'dd-M-yyyy',
														'todayHighlight' => true,
														'autoclose'=>true,
														'startDate'=> date('d-M-Y'),														 
													],
																
											]
											);
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
				<?php // $form->field($model, 'availability_to_date')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'availability_to_date')->widget(
											DatePicker::className(), [
												// 'name' => 'ItemInfo[availability_to_date]', 
													'value' => date('d-M-Y'),
													'type' => DatePicker::TYPE_COMPONENT_APPEND,
													'options' => ['placeholder' => 'Select end date','style'=>'height: 50px;, font-size: 16px;'],
													'pluginOptions' => [
														'format' => 'dd-M-yyyy',
														'todayHighlight' => true,
														'autoclose'=>true,
														'startDate'=> date('d-M-Y'),
													]
											]
											);
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
       <?= $form->field($model, 'ingredients')->textarea(['rows' => 6 ]) ?>
	 </div>

	 <div class="col-sm-12">	
       <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	 </div>
   
	 <div class="col-sm-12">	
	<?php
		$images_array=''; 
		$folder_name='item_images';
		$user_id=Yii::$app->user->id;
		if($model->image!=null){
			$images_array=yii\helpers\Url::to('@web/fuberme/').$user_id.'/'.$folder_name.'/'.$model->image;			
			echo '<img id="uploadPreview" src="'.$images_array.'"/>';
		}else{
			
		echo '<img id="uploadPreview" style="display:none;"/>';	
		}
		

		?>
		
		
		
	
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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
