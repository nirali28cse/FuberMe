<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DietaryPreference */

$this->title = 'Update Dietary Preference: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dietary Preferences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dietary-preference-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
