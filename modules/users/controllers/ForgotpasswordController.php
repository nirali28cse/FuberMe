<?php


namespace app\modules\users\controllers;

use Yii;
use app\modules\users\models\Userdetail;
use app\modules\users\models\UserdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\modules\users\models\Cuserdetail;

/**
 * ForgetpasswordController implements the CRUD actions for Userdetail model.
 */
class ForgotpasswordController extends Controller
{



    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Userdetail models.
     * @return mixed
     */
	 
	public function beforeAction($event)
    {
        $this->enableCsrfValidation = false;
		$before_login_action=array();
		$after_login_action=array();
		$before_login_action=array('index','index2','resetpass');

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
	

    public function actionIndex()
    {   
	
	    $model = new Cuserdetail();
		Yii::$app->session->set('forget_password', null);
		
        if ($model->load(Yii::$app->request->post())) {
				$model1=Cuserdetail::find()->where(['email_id'=>$_POST['Cuserdetail']['email_id']])->one();			
				if(count($model1)>0){
					$model=$model1;
					if($model->status==0){
						Yii::$app->session->set('forget_password','<div class="alert alert-danger">
						This email is not registered. Please check your email to confirm the registration, or register with a different email. Thank you!
						</div>');	
					}else{
						if ($model->save()) {	
							$send_email=Yii::$app->emailcomponent->Forgetpasswordresetlink($model->id);
							return $this->redirect(['/site/thankupass']);
						}
					}

				}else{
					Yii::$app->session->set('forget_password','<div class="alert alert-danger">
					This email does not exists,Please try again.
					</div>');	
				}
		}
		
        return $this->render('index', [
            'model' => $model,
        ]);
	}
	
	 
    public function actionIndex2($resetid, $key)
    {   
		Yii::$app->session->set('reset_password', null);
		
		$model = \app\modules\users\models\Cuserdetail::find()->where([
		'id'=>$resetid,
		'auth_key'=>$key,
		'status'=>1,
		])->one();		

        if(count($model)>0){
		
		}else{
			Yii::$app->session->set('reset_password','<div class="alert alert-danger">
			This Link is wrong,Please try again.
			</div>');	
		}	
		
		return $this->redirect(['resetpass', 'id' =>$model->id]);
	}	 
	
    public function actionChangepass()
    {
		$id=Yii::$app->user->id;
		$model =  Cuserdetail::findOne($id);	
        if(count($model)>0){
			if (Yii::$app->request->post()){
				$new_password=$_POST['new_password'];
				$reenter_password=$_POST['reenter_password'];
				if(($new_password==$reenter_password) and ($new_password!=null) and ($reenter_password!=null)){	
					$model->password=MD5($new_password);	
					if($model->save()){
						return $this->goHome();
					}
				}else{					
					Yii::$app->session->set('reset_password','<div class="alert alert-danger">
					Password Not Match,Please Enter Password Again.
					</div>');
				}		
			}
		}
		
		return $this->render('changepass', [
			'model' => $model,
		]);
	}
	
	
    public function actionResetpass($id)
    {   

		$model =  Cuserdetail::findOne($id);		
		$password_errormesg=null;
		
        if(count($model)>0){

			 if (Yii::$app->request->post()){
				$new_password=$_POST['new_password'];
				$reenter_password=$_POST['reenter_password'];
				if(($new_password==$reenter_password) and ($new_password!=null) and ($reenter_password!=null)){	
					$model->password=MD5($new_password);	
					if($model->save()){
						 Yii::$app->user->switchIdentity($model); // log in
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
							//if only chef
							if(Yii::$app->user->identity->user_type==3){
							//	return $this->goHome();
								return $this->redirect(['//iteminfo/index']);
							}
						}
					}
				}else{					
					Yii::$app->session->set('reset_password','<div class="alert alert-danger">
					Enter Password Again.
					</div>');
				}		
			}
			
			return $this->render('resetpass', [
				'model' => $model,
			]);
				
		}

	}	 
	
	
	
/* 	public function actionIndex()
    {

        $model = new Userdetail();
		$username_errormesg=null;
		$password_errormesg=null;
			
		if((isset($_POST['username']) and ($_POST['username']!=null))) {		
			$username=$_POST['username'];
			$model1 = Userdetail::findOne(['username'=>$username]);
			if(count($model1)>0){
				$new_password=$_POST['new_password'];
				$reenter_password=$_POST['reenter_password'];
				if(($new_password==$reenter_password) and ($new_password!=null) and ($reenter_password!=null)){	
					$model1->password=MD5($new_password);	
					if($model1->save()){
						 Yii::$app->user->switchIdentity($model1); // log in
						return $this->goHome();
					}
				}else{
					$password_errormesg='Verify Password Again.';
					return $this->render('index', [
						'model' => $model,
						'username_errormesg' =>$username_errormesg,
						'password_errormesg' =>$password_errormesg,
					]);
				}		
			}else{
				$username_errormesg='Username does not exist.';
				return $this->render('index', [
					'model' => $model,
					'username_errormesg' =>$username_errormesg,
					'password_errormesg' =>$password_errormesg,
				]);
			}
        } 		
            return $this->render('index', [
                'model' => $model,
				'username_errormesg' =>$username_errormesg,
				'password_errormesg' =>$password_errormesg,
            ]);

    }  */
	
}
