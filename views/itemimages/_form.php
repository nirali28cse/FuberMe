<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use app\models\ItemImages;
/* @var $this yii\web\View */
/* @var $model app\models\ItemImages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-images-form">

    <?php 	
	$form = ActiveForm::begin([
		'options'=>['enctype'=>'multipart/form-data'] // important
	]); ?>

    <?php // $form->field($model, 'image_path')->textInput(['maxlength' => true]) ?>
	
		<?php
		/* echo FileInput::widget([
			'name' => 'image_path[]',
			'options'=>[
				'accept' => 'image/*',
				'multiple'=>true,
			],
			'pluginOptions' => [
				'uploadUrl' => Url::to('@web/media/item_images'),
				'uploadExtraData' => [
					'item_info_id' => $_GET['iteminfoid'],
				],
				'maxFileCount' => 10,
				'showPreview' => true,
				'showCaption' => true,
				'showRemove' => true,
				'showUpload' => true,
				'allowedFileExtensions'=>['jpg', 'gif', 'png', 'bmp'],
			]
		]);
		 */
		 
		 
		 $item_images=ItemImages::find()->where(['item_info_id'=>$_GET['iteminfoid']])->all();
		 $images_array=array();
		 $user_id=Yii::$app->user->id;
		 $user_path = Yii::$app->basePath.'/media_content/'.$user_id.'/item_images/';	
		 foreach($item_images as $item_image){
			$images_array[]=$user_path.$item_image->image_path;	 
		 }

		 if($images_array!=null){
			 echo '<input type="hidden" name="delete_images" value="1">';
		 }
		
		echo $form->field($model, 'image_path[]')->widget(FileInput::classname(), [
				'options' => [
							'accept' => 'image/*',
							 'multiple' => true,
							 
							],
				'pluginOptions'=>[
						'allowedFileExtensions'=>['jpg', 'gif', 'png', 'bmp'],
						'uploadExtraData' => [
							'item_info_id' => $_GET['iteminfoid'],
						],
						'initialPreview' =>$images_array,
						'overwriteInitial' => false,
						'maxFileCount' =>5,
						'showPreview' => true,
						'showCaption' => true,
						'showRemove' => true,
						'showUpload' => true,
					],
				
			]);
		
		?>
		
	<br/>	

    <div class="form-group">
        <?php // Html::submitButton($model->isNewRecord ? 'Upload' : 'Upload', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
