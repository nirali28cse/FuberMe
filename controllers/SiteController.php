<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ItemInfo;
use app\models\ItemInfoSearch;
use app\models\ItemInfoLiveSearch;
use app\models\ItemInfoOfflineSearch;
use yii\data\ActiveDataProvider;
use app\modules\users\models\Userdetail;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
		
		// Yii::$app->response->statusCode;

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
/*             'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ], */
        ];
    }
	
	public function beforeAction($event)
    {
        
		$before_login_action=array();
		$after_login_action=array();
		$before_login_action=array('index','error','thanku','thankupass','redirectorder','faq','tou','sendemail','Confirm');

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
     * Displays homepage.
     *
     * @return string
     */
    public function actionRedirectorder()
    { 
		if(Yii::$app->user->isGuest){	
			// login
			return $this->redirect(['//users/login/index']);
		}else{
			$get_from=null;
			
			if(isset($_GET['from']) and ($_GET['from']!=null)){
				$get_from=$_GET['from'];	
				if($get_from=='chef'){
					return $this->redirect(['//orderinfo/index']);
				}elseif($get_from=='customer'){
					return $this->redirect(['//orderinfo/index2']);
				}
			}				
		}
	}
	
	
	
	public function actionIndex()
    {
		$this->layout = '/fuber_me/homepage';
		
		$min_location=0;
		$max_location=0;
		$search_by_item=null;
		$chef_array=array();
		
		if(isset($_GET['search_by_item']) and ($_GET['search_by_item']!=null)){
			$search_by_item=$_GET['search_by_item'];			
		}	
		if(isset($_GET['search_by_location']) and ($_GET['search_by_location']!=null)){
			$search_by_location=$_GET['search_by_location'];			
			

			$chef_distance_array=array();			
			
			$allchef_info = Userdetail::find()
			 ->where(['status'=>1])
			 ->where(['or','user_type=2','user_type=3'])
			 ->all();

			 if(count($allchef_info)>0){
				foreach($allchef_info as $allchef){
					$zipcode=$allchef->zipcode;
					$chef_id=$allchef->id;
					if($zipcode>0 and $zipcode!=null){
						$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=false";
						$details=file_get_contents($url);
						$result = json_decode($details,true);
						if($result['results']!=null){
							
							$lat=0;
							$lng=0;
							$lat=$result['results'][0]['geometry']['location']['lat'];
							$lng=$result['results'][0]['geometry']['location']['lng'];
							$chef_latitude=0;
							$chef_longitude=0;
							if($lat!=null)$chef_latitude=$lat;
							if($lng!=null)$chef_longitude=$lng;
								
							$chef_distance_array[$chef_id]=array('chef_latitude'=>$chef_latitude,'chef_longitude'=>$chef_longitude);	
						}							
					}
				}
			 }
			 
		 
			function distance($lat1, $lon1, $lat2, $lon2, $unit) {

			  $theta = $lon1 - $lon2;
			  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			  $dist = acos($dist);
			  $dist = rad2deg($dist);
			  $miles = $dist * 60 * 1.1515;
			  $unit = strtoupper($unit);

			  if ($unit == "K") {
				  return ($miles * 1.609344);
			  } else if ($unit == "N") {
				  return ($miles * 0.8684);
			  } else {
				  return $miles;
			  }
			}
			
			$allchef_info = Userdetail::find()->where(['status'=>1])
							->Where(['or',
								['LIKE','zipcode',$search_by_location],
								['LIKE','city',$search_by_location]
								])->all();;
			 $chef_zipcode=0;
			 if(count($allchef_info)>0){				
					$chef_array1=array();				
					foreach($allchef_info as $allchef){
						$chef_id=$allchef->id;
						$chef_zipcode=$allchef->zipcode;
						$chef_array[]=$chef_id;
						$chef_array1[$chef_zipcode]=$chef_id;
					}
					$min_location=1;
					$max_location=1;

				$location_chef_id=0;	
				$location_chef_id=$chef_array1[$chef_zipcode];

				if($chef_zipcode!=null and array_key_exists($location_chef_id,$chef_distance_array)){

					$location_info=$chef_distance_array[$location_chef_id];
					$location_latitude=$location_info['chef_latitude'];
					$location_longitude=$location_info['chef_longitude'];

				
				$location_distance_array=array();
				if($chef_distance_array!=null){
					foreach($chef_distance_array as $chef_id=>$chef_distance){
						$chef_latitude=$chef_distance['chef_latitude'];
						$chef_longitude=$chef_distance['chef_longitude'];					
						$location_distance_array[$chef_id]=distance($location_latitude,$chef_latitude,$location_longitude,$chef_longitude, "M"); 
					}
				}
				
				$search_loca_dist=0;
				$equal_distance_array=array();
				$less_distance_array=array();
				$greter_distance_array=array();

				$new_chef_array=array();
				if($location_distance_array!=null){				
					$search_loca_dist=$location_distance_array[$location_chef_id];
					foreach($location_distance_array as $chef_id=>$location_distance){
						if($search_loca_dist==$location_distance){
							$equal_distance_array[]=$chef_id;
						}elseif($search_loca_dist>$location_distance){
							$less_distance_array[]=$chef_id;
						}elseif($search_loca_dist<$location_distance){
							$greter_distance_array[]=$chef_id;
						}
					}				
				}
				
				$merge_array1=array_merge($equal_distance_array,$less_distance_array);
				$new_chef_array=array_merge($merge_array1,$greter_distance_array);
				$chef_array=$new_chef_array;
			 }

			}else{
				$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$search_by_location."&sensor=false";
				$details=file_get_contents($url);
				$result = json_decode($details,true);
				
				
				if($result['results']!=null){					
					$lat=0;
					$lng=0;
					$lat=$result['results'][0]['geometry']['location']['lat'];
					$lng=$result['results'][0]['geometry']['location']['lng'];
					$chef_latitude=0;
					$chef_longitude=0;
					if($lat!=null)$chef_latitude=$lat;
					if($lng!=null)$chef_longitude=$lng;
						
					$location_distance_array=array();	
					$location_distance_array[0]=array('chef_latitude'=>$chef_latitude,'chef_longitude'=>$chef_longitude);	

					$location_latitude=$chef_latitude;
					$location_longitude=$chef_longitude;
					
					
					if($chef_distance_array!=null){
						foreach($chef_distance_array as $chef_id=>$chef_distance){
							$chef_latitude=$chef_distance['chef_latitude'];
							$chef_longitude=$chef_distance['chef_longitude'];					
							$location_distance_array[$chef_id]=distance($location_latitude,$chef_latitude,$location_longitude,$chef_longitude, "M"); 
						}
					}
					
					$search_loca_dist=0;
					$equal_distance_array=array();
					$less_distance_array=array();
					$greter_distance_array=array();

					$new_chef_array=array();
					if($location_distance_array!=null){				
						$search_loca_dist=$location_distance_array[0];
						foreach($location_distance_array as $chef_id=>$location_distance){
							if($search_loca_dist==$location_distance){
								$equal_distance_array[]=$chef_id;
							}elseif($search_loca_dist>$location_distance){
								$less_distance_array[]=$chef_id;
							}elseif($search_loca_dist<$location_distance){
								$greter_distance_array[]=$chef_id;
							}
						}				
					}
					
					$merge_array1=array_merge($equal_distance_array,$less_distance_array);
					$new_chef_array=array_merge($merge_array1,$greter_distance_array);
					$chef_array=$new_chef_array;
						
				}

			}
		}
							
		if($chef_array!=null or $search_by_item!=null){
			$_SESSION['filetrsarray']=array(
										'min_location'=>$min_location,
										'max_location'=>$max_location,
										'chef_array'=>$chef_array,
										'search_by_item'=>$search_by_item,
										'min_price'=>0,
										'max_price'=>0,
										'cusion_array'=>array(),
										'dieta_array'=>array(),
										'categ_array'=>array(),
										);
		}


		//update offline live items
		// Call functtion for to update item 
		Yii::$app->mediacomponent->Updateitemstatus();	
		//update offline live items
		
		
		
        $livesearchModel = new ItemInfoLiveSearch(); 
        $livedataProvider = $livesearchModel->search(Yii::$app->request->queryParams); 
				
        $offlinesearchModel = new ItemInfoOfflineSearch(); 
        $offlinedataProvider = $offlinesearchModel->search(Yii::$app->request->queryParams); 

		if (Yii::$app->request->isAjax){
			return $this->renderAjax('/iteminfo/conhomeitem', [
					'livedataProvider' => $livedataProvider,
					'offlinedataProvider' => $offlinedataProvider,
				]);
		}else{
 			return $this->render('index', [
				'livedataProvider' => $livedataProvider,
				'offlinedataProvider' => $offlinedataProvider,
			]); 
			 
		} 

    }  
	
	
	/* 
    public function actionIndex()
    {
		$this->layout = '/fuber_me/homepage';
		

		if(isset($_GET['search_by_item']) and ($_GET['search_by_item']!=null)){
			$search_by_item=$_GET['search_by_item'];
			$query = ItemInfo::find()->where(['status' => 1])
					->andFilterWhere(['<=', 'availability_from_date', date('Y-m-d')])
				    ->andFilterWhere(['>=', 'availability_to_date', date('Y-m-d')])
				    ->andFilterWhere(['LIKE', 'name', $search_by_item]);
		}elseif(isset($_GET['search_by_location']) and ($_GET['search_by_location']!=null)){
			$search_by_location=$_GET['search_by_location'];
			
			$allchef_info = Userdetail::find()->where(['status'=>1])
							->Where(['or',
								['LIKE','zipcode',$search_by_location],
								['LIKE','state',$search_by_location],
								['LIKE','city',$search_by_location]
								])->all();;

			 $query = ItemInfo::find();	
			 $query->andFilterWhere(['=', 'status',1])
					->andFilterWhere(['<=', 'availability_from_date', date('Y-m-d')])
				    ->andFilterWhere(['>=', 'availability_to_date', date('Y-m-d')]);
			 $chef_array=array();
			 if(count($allchef_info)>0){
				foreach($allchef_info as $allchef){
					$chef_id=$allchef->id;
					$chef_array[]=$chef_id;
				//	$query->orFilterWhere(['=', 'chef_user_id', $chef_id]);
				}
				$query->andFilterWhere(['in','chef_user_id',$chef_array]);	
			 }

		}else{
			$newhours = date("H");
			$newminiute = date("i");
			$newTime = $newhours.':'.$newminiute;
			
			$query = ItemInfo::find()->andFilterWhere(['status' => 1])
					->andFilterWhere(['<=', 'availability_from_date', date('Y-m-d')])
				    ->andFilterWhere(['>=', 'availability_to_date', date('Y-m-d')]);
		}	



		$livedataProvider = new ActiveDataProvider([
			'query' =>$query,
			'pagination' => [
				'pageSize' => 6,
			],
		]);

		// get the posts in the current page
		$models  = $livedataProvider->getModels();
		// $count = $livedataProvider->getCount();
		
        return $this->render('index', [
      //   'searchModel' => $searchModel,
         //   'searchModel1' => $searchModel1,
            'livedataProvider' => $livedataProvider,
         //   'offlinedataProvider' => $offlinedataProvider,
        ]);
		
      //  return $this->render('index');
    }   */
	
/*     public function actionIndex2()
    {
		  echo '<pre/>';
		  print_r(Yii::$app->paypal->payDemo());  
		  exit();
    }    */
	
	

/* 	public function actionError()
    {
		echo 'hii';
		exit;
		$this->layout = '/fuber_me/homepage';
		
		$exception = Yii::$app->errorHandler->exception;
		if ($exception !== null) {
			return $this->render('error', ['exception' => $exception]);
		}

    } */
		

			
	public function actionError()
	{
		$exception = Yii::$app->errorHandler->exception;
		if ($exception !== null) {
			return $this->render('error', ['exception' => $exception]);
		}
	}
	
	public function actionThanku()
    {
		$this->layout = '/fuber_me/homepage';
        return $this->render('thanku');
    }
	
	public function actionThankupass()
    {
		$this->layout = '/fuber_me/homepage';
        return $this->render('thankupass');
    }
	
	public function actionFaq()
    {
		$this->layout = '/fuber_me/homepage';
        return $this->render('faq');
    }
	
	
	public function actionTou()
    {
		$this->layout = '/fuber_me/homepage';
        return $this->render('tou');
    }
	
  /*   public function actionProducts()
    {
		$this->layout = '/fuber_me/homepage';
        return $this->render('products');
    }
    public function actionSingle()
    {
		$this->layout = '/fuber_me/homepage';
        return $this->render('single');
    }
    public function actionCart()
    {
		$this->layout = '/fuber_me/homepage';
        return $this->render('cart');
    }   */

    /**
     * Login action.
     *
     * @return string
     */
   /*  public function actionLogin()
    {
		$this->layout = '/fuber_me/homepage';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    } */

    /**
     * Logout action.
     *
     * @return string
     */
  /*   public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
 */
    /**
     * Displays contact page.
     *
     * @return string
     */
/*     public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    } */

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionSendemail($uid)
    {
		$send_email=Yii::$app->emailcomponent->Userregistrationverification($uid);
		return $this->redirect(['//site/thanku']);			
    }  

/* 	public function actionAbout()
    {
        return $this->render('about');
    } */
		
	public function actionConfirm($id, $key)
	{
			$model = \app\modules\users\models\Userdetail::find()->where([
			'id'=>$id,
			'auth_key'=>$key,
			'status'=>0,
			])->one();

			if(!empty($model)){
				
				if($model->user_type==1){
					$model = \app\modules\users\models\Cuserdetail::find()->where([
					'id'=>$id,
					'auth_key'=>$key,
					'status'=>0,
					])->one();
				}				
			
				$model->status=1;				
				$model->save();
				

				Yii::$app->user->switchIdentity($model); // log in
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
		
		return $this->goHome();
	}
		
}
