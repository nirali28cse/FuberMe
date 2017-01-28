<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderInfo */

$this->title = 'Conform Order Details';
$this->params['breadcrumbs'][] = ['label' => 'Order Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-info-create">

    <h2><?= Html::encode($this->title) ?></h2>
	<br/>
    <?= $this->render('_form', [
        'model' => $model,
		'order_array' => $order_array,
    ]) ?>

</div>
