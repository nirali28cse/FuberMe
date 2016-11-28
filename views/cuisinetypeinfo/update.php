<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CuisineTypeInfo */

$this->title = 'Update Cuisine Type Info: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cuisine Type Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuisine-type-info-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
