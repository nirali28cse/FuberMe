<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\DietaryPreference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dietary-preference-form">

    <?php $form = ActiveForm::begin(); ?>

	
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
					'type' => SwitchInput::CHECKBOX,
					 'pluginOptions' => [
							'onColor' => 'success',
							'onText' => 'Active',
							'offText' => 'NotActive',
						]
				]);
				 ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
