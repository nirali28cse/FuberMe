<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_number',
            'final_amount',
            'total_amount',
            'user_id',
            // 'customer_name',
            // 'customer_email:email',
            // 'customer_mobile_no',
            // 'customer_address:ntext',
            // 'customer_city',
            // 'customer_state',
            // 'customer_zip',
            // 'delivery_method',
            // 'payment_method',
            // 'tax_in_percent',
            // 'order_notes:ntext',
            // 'order_status',
            // 'order_date_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
