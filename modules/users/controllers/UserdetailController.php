<?php

namespace app\modules\users\controllers;

use Yii;
use app\modules\users\models\Userdetail;
use app\modules\users\models\UserdetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserdetailController implements the CRUD actions for Userdetail model.
 */
class UserdetailController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                 //   'delete' => ['post'],
                ],
            ],
        ];
    }

	public function beforeAction($event)
    {
        $this->enableCsrfValidation = false;
		$before_login_action=array();
		$after_login_action=array();
	//	$before_login_action=array('index','error','thanku','thankupass','faq','tou','Sendemail','Confirm');

		$action=Yii::$app->controller->action->id;
		$allow_action=false;
		// check is user loged in 
		if(Yii::$app->user->isGuest){
			if(in_array($action,$before_login_action)) $allow_action=true;
		}else{
			$allow_action=true;
		}
		
		if(!$allow_action){
			 return $this->goHome();
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
		if(Yii::$app->user->identity->is_admin==1){
			$searchModel = new UserdetailSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
    }  

/* 	public function actionIndexcust()
    {
        $searchModel = new UserdetailSearch();
		$searchModel->user_type=1;	
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } */

    /**
     * Displays a single Userdetail model.
     * @param integer $id
     * @return mixed
     */
/*     public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    } */

    /**
     * Creates a new Userdetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
/*     public function actionCreate()
    {
        $model = new Userdetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    } */

    /**
     * Updates an existing Userdetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
/*     public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    } */

    /**
     * Deletes an existing Userdetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(Yii::$app->user->identity->is_admin==1){
			$this->findModel($id)->delete();
			return $this->redirect(['index']);
		}
    }  


    /**
     * Finds the Userdetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Userdetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Userdetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
