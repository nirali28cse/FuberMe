<?php


namespace app\modules\users\controllers;

use Yii;
use app\modules\users\models\Userdetail;
use app\modules\users\models\UserdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
/**
 * RegistrationController implements the CRUD actions for Userdetail model.
 */
class LoginController extends Controller
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

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {			
             return $this->redirect(['//site/dashbord']);
        }
		
        return $this->render('index', [
            'model' => $model,
        ]);
    } 
	
	 public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
}
