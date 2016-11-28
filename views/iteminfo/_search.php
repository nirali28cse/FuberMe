<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'chef_user_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'item_category_info_id') ?>

    <?php // echo $form->field($model, 'item_cuisine_type_info_id') ?>

    <?php // echo $form->field($model, 'ingredients') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'delivery_method') ?>

    <?php // echo $form->field($model, 'head_up_time') ?>

    <?php // echo $form->field($model, 'availability_from') ?>

    <?php // echo $form->field($model, 'availability_to') ?>

    <?php // echo $form->field($model, 'date_time') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
