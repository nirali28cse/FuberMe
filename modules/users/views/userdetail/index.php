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
		    'fullname',
			
            'email:email',
		
             [
				'attribute' => 'status',
				'format' => 'raw',
				'value' => function ($model) {
					return $model->status == 0 ? "In Active" : "Active";
				},
			],

            // 'auth_key',
            // 'create_at',
            // 'lastvisit_at',
            // 'superuser',
            // 'status',
            // 'is_agree_with_terms_conditions',
            // 'is_employeer',
            // 'is_job_seeker',
             'api_key',
             'api_sn',

           	[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}',			
			],
        ],
    ]); 
	
	
Pjax::end();
	?>

</div>
