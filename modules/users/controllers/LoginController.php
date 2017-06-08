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

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //    'idealusertimeout' => ['post'],
                ],
            ],
        ];
    }
	
	
	public function beforeAction($event)
    {
        $this->enableCsrfValidation = false;
		$before_login_action=array();
		$after_login_action=array();
		$before_login_action=array('index');

		$action=Yii::$app->controller->action->id;
		$allow_action=false;
		// check is user loged in 
		if(Yii::$app->user->isGuest){
			if(in_array($action,$before_login_action)) $allow_action=true;
		}else{
			$allow_action=true;
		}
		
		if(!$allow_action){
			return $this->goHome()->send();
		}else{
			return parent::beforeAction($event);
		}
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
				
				if(isset($_GET['directorder']) and ($_GET['directorder']>0)){
					$directorder=$_GET['directorder'];
					return $this->redirect(['/orderinfo/review', 'itemid' =>$directorder, 'directorder' =>$directorder]);
				}else{
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
				}

			}else{		
				$user_id=Yii::$app->user->id;
				Yii::$app->user->logout();					
				Yii::$app->session->set('verify_email','<div class="alert alert-danger">Please Verify Your email and then try login.
				<a href="'.Yii::$app->homeUrl.'?r=site/sendemail&uid='.$user_id.'" style="float:right;">Resend verification email.</a>
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
		if (!Yii::$app->user->isGuest) {		
			unset($_SESSION['order_array']);
			unset($_SESSION['master_chef']);
			unset($_SESSION['master_chef_name']);
			unset($_SESSION['filetrsarray']);
			unset($_SESSION);
			Yii::$app->user->logout();
			return $this->goHome();
		}
    }


	public function actionIdealusertimeout()
	{
		// Yii::$app->controller->enableCsrfValidation = false;
		if (!Yii::$app->user->isGuest) {
			Yii::$app->user->logout();
			return 1;
		}else{
			return 2;
		} 
	}
	
}
