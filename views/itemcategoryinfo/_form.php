<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemCategoryInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-category-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'parent_id')->textInput() ?>
	
	<?php 
	 $item_category_info[0]='Is Parent';
	 $item_category_info_ids = yii\helpers\ArrayHelper::map(app\models\ItemCategoryInfo::find()->where(['status'=>1])->all(), 'id', 'name'); 
	 $item_category_info_id=array_merge($item_category_info,$item_category_info_ids);
	 ?>
	<?= $form->field($model, 'parent_id')
        ->dropDownList(
            $item_category_info_id,           // Flat array ('id'=>'label')
            ['prompt'=>'Select Category']    // options
        );
	?>	

	
	<?= $form->field($model, 'status')->radioList([1 => 'Active', 0 => 'InActive']); ?> 


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
