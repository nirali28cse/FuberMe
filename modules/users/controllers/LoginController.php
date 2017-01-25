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
		Yii::$app->session->set('verify_email', null);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {			
			if(Yii::$app->user->identity->status==1){
				
				// if admin 
				if(Yii::$app->user->identity->is_admin==1){
					return $this->redirect(['//cuisinetypeinfo/index']);
				}else{
					//if only customer
					if(Yii::$app->user->identity->user_type==1){
						return $this->redirect(['//iteminfo/conhome']);
					}
					//if only chef
					if(Yii::$app->user->identity->user_type==2){
						return $this->redirect(['//iteminfo/index']);
					}	
					//if only Both
					if(Yii::$app->user->identity->user_type==3){
					//	return $this->goHome();
						return $this->redirect(['//iteminfo/index']);
					}
				}

			}else{		
				$user_id=Yii::$app->user->id;
				Yii::$app->user->logout();					
				Yii::$app->session->set('verify_email','<div class="alert alert-danger">Please Verify Your email and then try login.
				<a href="'.Yii::$app->homeUrl.'?r=site/sendemail&uid='.$user_id.'" style="float:right;">Click Here To Get Conformation Email.</a>
				</div>');				
			}             
        }
		
        return $this->render('index', [
            'model' => $model,
        ]);
    }   

	/* public function actionClogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {			
			if(Yii::$app->user->identity->user_type==2){
				return $this->redirect(['//iteminfo/index']);
			}elseif(Yii::$app->user->identity->is_admin==1){
				return $this->redirect(['//cuisinetypeinfo/index']);
			}else{
				 return $this->goHome();
			}
        }
		
        return $this->render('clogin', [
            'model' => $model,
        ]);
    } 
	 */
	 public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
}
