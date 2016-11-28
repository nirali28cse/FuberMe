<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CuisineTypeInfo */

$this->title = 'Create Cuisine Type Info';
$this->params['breadcrumbs'][] = ['label' => 'Cuisine Type Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuisine-type-info-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
