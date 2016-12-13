<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemInfo */

$this->title = 'Add Item';
$this->params['breadcrumbs'][] = ['label' => 'Item Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="item-info-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

