<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-images-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Images', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'item_info_id',
            'image_path',
            'date_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
