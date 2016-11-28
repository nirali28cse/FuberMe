<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItemInfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Item Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'chef_user_id',
            'name',
            'price',
            'item_category_info_id',
            'item_cuisine_type_info_id',
            'ingredients:ntext',
            'description:ntext',
            'delivery_method',
            'head_up_time',
            'availability_from',
            'availability_to',
            'date_time',
            'status',
        ],
    ]) ?>

</div>
