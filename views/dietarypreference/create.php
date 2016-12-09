<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DietaryPreference */

$this->title = 'Create Dietary Preference';
$this->params['breadcrumbs'][] = ['label' => 'Dietary Preferences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dietary-preference-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
