<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\users\models\Userdetail */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Userdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userdetail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'password',
            'email:email',
            'name',
            'auth_key',
            'create_at',
            'lastvisit_at',
            'superuser',
            'status',
            'is_agree_with_terms_conditions',
            'is_employeer',
            'is_job_seeker',
            'is_seller',
            'is_advertiser',
        ],
    ]) ?>

</div>
