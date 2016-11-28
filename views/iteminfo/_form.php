<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
	
	<?php $item_cuisine_type_info_id = yii\helpers\ArrayHelper::map(app\models\CuisineTypeInfo::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
	<?= $form->field($model, 'item_cuisine_type_info_id')
        ->dropDownList(
            $item_cuisine_type_info_id,           // Flat array ('id'=>'label')
            ['prompt'=>'Select Cuisine']    // options
        );
	?>
	
	<?php $item_category_info_id = yii\helpers\ArrayHelper::map(app\models\ItemCategoryInfo::find()->where(['status'=>1])->all(), 'id', 'name'); ?>
	<?= $form->field($model, 'item_category_info_id')
        ->dropDownList(
            $item_category_info_id,           // Flat array ('id'=>'label')
            ['prompt'=>'Select Category']    // options
        );
	?>	


    <?= $form->field($model, 'ingredients')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'delivery_method')
        ->dropDownList(
            Yii::$app->params['delivery_method'],           // Flat array ('id'=>'label')
            ['prompt'=>'Select Delivery Method']    // options
        );
	?>
	
    <?= $form->field($model, 'head_up_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'availability_from_date')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'availability_from_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'availability_to_date')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'availability_to_time')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'status')->radioList([1 => 'Active', 0 => 'InActive']); ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
