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
	
	public function beforeAction($event)
    {
        $this->enableCsrfValidation = false;
		$before_login_action=array();
		$after_login_action=array();
		$before_login_action=array('index','cindex');

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

		// $this->layout = '/zorens_main/front_layout/registration';
		Yii::$app->session->set('email_error', null);
        $model = new Userdetail();
		$user_type=2;
		$usend_email=1;	
		if (isset($_POST['Userdetail'])) {
			$model1=Userdetail::find()->where(['email_id'=>$_POST['Userdetail']['email_id']])->where(['user_type'=>'!2'])->one();
			if(count($model1)>0){
				$user_type=3;
				$model=$model1;
				if($model->status==1){
					$usend_email=0;	
				}	
			}
		}
		if ($model->load(Yii::$app->request->post())) {
		
			if (isset($_POST['Userdetail'])) {
				$password=$_POST['Userdetail']['password'];
				$model->password=MD5($password);	
				$model->user_type=$user_type;	
				$model->auth_key =  Yii::$app->getSecurity()->generateRandomString();
				
				// store lat and long
				$zipcode=$model->zipcode;
				if($zipcode>0 and $zipcode!=null){		
					$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&key=".Yii::$app->params['geo_location_api_fey'];
					$details=file_get_contents($url);
					$result = json_decode($details,true);
					if($result['results']!=null){						
						$lat=0;
						$lng=0;
						$lat=$result['results'][0]['geometry']['location']['lat'];
						$lng=$result['results'][0]['geometry']['location']['lng'];
						$chef_latitude=null;
						$chef_longitude=null;
						if($lat!=null)$chef_latitude=$lat;
						if($lng!=null)$chef_longitude=$lng;
						$model->zipcode_lat=$chef_latitude;
						$model->zipcode_lng=$chef_longitude;
					}							
				}
				// store lat and long
				
			}

			if($model->save()){
				
				if($usend_email==1){
	
					$send_email=Yii::$app->emailcomponent->Userregistrationverification($model->id);
					
					if($send_email==1){
						return $this->redirect(['//site/thanku']);	
					}else{
						$this->findModel($model->id)->delete();
						Yii::$app->session->set('email_error','<div class="alert alert-danger">This email id is not valid,please try again.</div>');
					}	
				}else{
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
			}

        } 
		
            return $this->render('create', [
                'model' => $model,
            ]);

    }  


	public function actionCindex()
    {

        $model = new Cuserdetail();

		if ($model->load(Yii::$app->request->post())) {
		    Yii::$app->session->set('email_error', null);
			$usend_email=1;
			if (isset($_POST['Cuserdetail'])) {
				$password=$_POST['Cuserdetail']['password'];
				$model->password=MD5($password);	 
				$model->user_type=1;	
			}
			

			if (isset($_POST['Cuserdetail'])) {
				$model1=Cuserdetail::find()->where(['email_id'=>$_POST['Cuserdetail']['email_id']])->one();
				if(count($model1)>0){
					$model=$model1;
					$model->user_type=3;	
					if($model->status==1){
						$usend_email=0;	
					}					
				}				
			}
			$model->auth_key =  Yii::$app->getSecurity()->generateRandomString();
			
			
			if (isset($_POST['Userdetail'])) {
				$password=$_POST['Userdetail']['password'];
				$model->password=MD5($password);	
				$model->user_type=$user_type;	
				$model->auth_key =  Yii::$app->getSecurity()->generateRandomString();
			}
		
			if(isset($_GET['directorder']) and ($_GET['directorder']>0)){
				$directorder=$_GET['directorder'];				
				$model->status=1;	
				$usend_email=0;	
			}
			
			
			
		   // store lat and long
			$zipcode=$model->zipcode;
			if($zipcode>0 and $zipcode!=null){		
				$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&key=".Yii::$app->params['geo_location_api_fey'];
				$details=file_get_contents($url);
				$result = json_decode($details,true);
				if($result['results']!=null){						
					$lat=0;
					$lng=0;
					$lat=$result['results'][0]['geometry']['location']['lat'];
					$lng=$result['results'][0]['geometry']['location']['lng'];
					$chef_latitude=null;
					$chef_longitude=null;
					if($lat!=null)$chef_latitude=$lat;
					if($lng!=null)$chef_longitude=$lng;
					$model->zipcode_lat=$chef_latitude;
					$model->zipcode_lng=$chef_longitude;
				}							
			}
			// store lat and long
				
				
			if($model->save()){				
				if($usend_email==1){
		
					$send_email=Yii::$app->emailcomponent->Userregistrationverification($model->id);
					
					if($send_email==1){
						return $this->redirect(['//site/thanku']);	
					}else{
						$this->findModel($model->id)->delete();
						Yii::$app->session->set('email_error','<div class="alert alert-danger">This email id is not valid,please try again.</div>');
					}	
				}else{				
					
					 Yii::$app->user->switchIdentity($model); // log in
					 
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
							//if only chef
							if(Yii::$app->user->identity->user_type==3){
							//	return $this->goHome();
								return $this->redirect(['//iteminfo/index']);
							}
						}
					}
				}				
			}

        }
	
		return $this->render('cindex', [
			'model' => $model,
		]);

    } 
	
	
    public function actionUpdate()
    {
		$id=Yii::$app->user->id;
        $model = $this->findModel($id);
		if($model->user_type==1){
			$model1 = Cuserdetail::findOne($id);
			$model=$model1;
		}
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
			
		   // store lat and long
			$zipcode=$model->zipcode;
			if($zipcode>0 and $zipcode!=null){		
				$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&key=".Yii::$app->params['geo_location_api_fey'];
				$details=file_get_contents($url);
				$result = json_decode($details,true);
				if($result['results']!=null){						
					$lat=0;
					$lng=0;
					$lat=$result['results'][0]['geometry']['location']['lat'];
					$lng=$result['results'][0]['geometry']['location']['lng'];
					$chef_latitude=null;
					$chef_longitude=null;
					if($lat!=null)$chef_latitude=$lat;
					if($lng!=null)$chef_longitude=$lng;
					$model->zipcode_lat=$chef_latitude;
					$model->zipcode_lng=$chef_longitude;
					$model->save();
				}							
			}
			// store lat and long
			
			
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
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
    protected function findModel($id)
    {
        if (($model = Userdetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
}
