<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\users\models\Userdetail */

$this->title = 'Update Userdetail: ' . ' ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Userdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="userdetail-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
