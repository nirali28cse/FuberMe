<?php

namespace app\controllers;

use Yii;
use app\models\CuisineTypeInfo;
use app\models\CuisineTypeInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CuisinetypeinfoController implements the CRUD actions for CuisineTypeInfo model.
 */
class CuisinetypeinfoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

	public function beforeAction($event)
    {
        
		$before_login_action=array();
		$after_login_action=array();
	//	$before_login_action=array('index','error','thanku','thankupass','faq','tou','Sendemail','Confirm');

		$action=Yii::$app->controller->action->id;
		$allow_action=false;
		// check is user loged in 
		if(Yii::$app->user->isGuest){
			if(in_array($action,$before_login_action)) $allow_action=true;
		}else{
			if(Yii::$app->user->identity->is_admin==1){
				$allow_action=true;
			}
		}
		
		if(!$allow_action){
			 return $this->goHome();
		}else{
			return parent::beforeAction($event);
		}
		
    }
	
    /**
     * Lists all CuisineTypeInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CuisineTypeInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CuisineTypeInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CuisineTypeInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CuisineTypeInfo();

        if ($model->load(Yii::$app->request->post())) {
			$model->chef_user_id=Yii::$app->user->id;
			if ($model->save()) {
				return $this->redirect(['index']);
			}else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CuisineTypeInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			$model->chef_user_id=Yii::$app->user->id;
			if ($model->save()) {
				return $this->redirect(['index']);
			}else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CuisineTypeInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CuisineTypeInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CuisineTypeInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CuisineTypeInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
