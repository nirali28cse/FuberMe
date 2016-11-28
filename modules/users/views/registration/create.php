<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\users\models\Userdetail */

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = ['label' => 'Userdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


									
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
