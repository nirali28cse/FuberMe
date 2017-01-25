<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
        return $this->render('index');
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
