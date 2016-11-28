<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemInfo */

$this->title = 'Create Item Info';
$this->params['breadcrumbs'][] = ['label' => 'Item Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="item-info-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

