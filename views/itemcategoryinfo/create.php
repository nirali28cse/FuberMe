<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItemCategoryInfo */

$this->title = 'Create Menu';
$this->params['breadcrumbs'][] = ['label' => 'Item Category Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-category-info-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
