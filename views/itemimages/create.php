<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemImages */

$this->title = 'Create Item Images';
$this->params['breadcrumbs'][] = ['label' => 'Item Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
