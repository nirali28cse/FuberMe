<?php


namespace app\modules\users\controllers;

use Yii;
use app\modules\users\models\Userdetail;
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
			}
			
			if($model->save()){
				 Yii::$app->user->switchIdentity($model); // log in
				return $this->goHome();
			}

        } 
		
            return $this->render('create', [
                'model' => $model,
            ]);

    } 
	
}
