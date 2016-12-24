<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UserdetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Userdetails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="userdetail-index">

    <?php  Pjax::begin();
 // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    //    'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //  'id',
            'username',
           // 'password',
            'email_id',
            'mobile_number',
            [
				'attribute' => 'Identity',
				'format' => 'raw',
				'value' => function ($model) {
					if($model->user_type == 1){
						return  "Customer";
					}	
					if($model->user_type == 2){
						return  "Chef";
					}			
					if($model->user_type == 3){
						return  "Chef & Customer";
					}	
					if($model->user_type == 0){
						return  "Admin";
					}
					
				},
			],
           	[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{delete}',			
			],
        ],
    ]); 
	
	
Pjax::end();
	?>

</div>
