<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_number') ?>

    <?= $form->field($model, 'final_amount') ?>

    <?= $form->field($model, 'total_amount') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'customer_name') ?>

    <?php // echo $form->field($model, 'customer_email') ?>

    <?php // echo $form->field($model, 'customer_mobile_no') ?>

    <?php // echo $form->field($model, 'customer_address') ?>

    <?php // echo $form->field($model, 'customer_city') ?>

    <?php // echo $form->field($model, 'customer_state') ?>

    <?php // echo $form->field($model, 'customer_zip') ?>

    <?php // echo $form->field($model, 'delivery_method') ?>

    <?php // echo $form->field($model, 'payment_method') ?>

    <?php // echo $form->field($model, 'tax_in_percent') ?>

    <?php // echo $form->field($model, 'order_notes') ?>

    <?php // echo $form->field($model, 'order_status') ?>

    <?php // echo $form->field($model, 'order_date_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
