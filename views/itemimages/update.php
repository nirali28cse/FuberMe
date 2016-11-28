<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemImages */

$this->title = 'Update Item Images: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Item Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-images-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
