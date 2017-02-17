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
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$this->layout = '/fuber_me/homepage';
		
/*         $searchModel = new ItemInfoSearch();
		$searchModel->status=1;	
		$_GET['liveitem']=1;	 */
		

		
     //   $livedataProvider = $searchModel->search(Yii::$app->request->queryParams);
	 
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
    }  
	
    public function actionIndex2()
    {
		  echo '<pre/>';
		  print_r(Yii::$app->paypal->payDemo());  
		  exit();
    }   

	public function actionThanku()
    {
		$this->layout = '/fuber_me/homepage';
        return $this->render('thanku');
    }
	
	public function actionFaq()
    {
		$this->layout = '/fuber_me/homepage';
        return $this->render('faq');
    }
	
    public function actionProducts()
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
    }  

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
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
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

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

	public function actionAbout()
    {
        return $this->render('about');
    }
		
	public function actionConfirm($id, $key)
	{
			$model = \app\modules\users\models\Userdetail::find()->where([
			'id'=>$id,
			'auth_key'=>$key,
			'status'=>0,
			])->one();
			if(!empty($model)){
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
