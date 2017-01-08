<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\users\models\Userdetail */

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = ['label' => 'Userdetails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
     $email_error=Yii::$app->session->get('email_error');
	 if(!is_null($email_error)){
		 echo $email_error;
	 }
?>
									
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
