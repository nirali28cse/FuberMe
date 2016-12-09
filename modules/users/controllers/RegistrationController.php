<?php


namespace app\modules\users\controllers;

use Yii;
use app\modules\users\models\Userdetail;
use app\modules\users\models\Cuserdetail;
use app\modules\users\models\UserdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistrationController implements the CRUD actions for Userdetail model.
 */
class RegistrationController extends Controller
{



    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Userdetail models.
     * @return mixed
     */
    public function actionIndex()
    {

		// $this->layout = '/zorens_main/front_layout/registration';
		
        $model = new Userdetail();

		if ($model->load(Yii::$app->request->post())) {
		
			if (isset($_POST['Userdetail'])) {
				$password=$_POST['Userdetail']['password'];
				$model->password=MD5($password);	
				$model->user_type=2;	
			}
			
			if($model->save()){
				 Yii::$app->user->switchIdentity($model); // log in
				if(Yii::$app->user->identity->user_type==1){
					 return $this->goHome();
				}else{
					return $this->redirect(['//iteminfo/index']);
				}
			}

        } 
		
            return $this->render('create', [
                'model' => $model,
            ]);

    }  


	public function actionCindex()
    {

		// $this->layout = '/zorens_main/front_layout/registration';
		
        $model = new Cuserdetail();

		if ($model->load(Yii::$app->request->post())) {
		
			if (isset($_POST['Cuserdetail'])) {
				$password=$_POST['Cuserdetail']['password'];
				$model->password=MD5($password);	
				$model->user_type=1;	
			}
			
			if($model->save()){
				 Yii::$app->user->switchIdentity($model); // log in
				if(Yii::$app->user->identity->user_type==1){
					 return $this->goHome();
				}else{
					return $this->redirect(['//iteminfo/index']);
				}
			}

        } 
		
            return $this->render('cindex', [
                'model' => $model,
            ]);

    } 
	
}
