<?php

namespace app\controllers;

use Yii;
use app\models\ItemInfo;
use app\models\ItemInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Mediaopration;
use yii\web\UploadedFile;
/**
 * IteminfoController implements the CRUD actions for ItemInfo model.
 */
class IteminfoController extends Controller
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
                  //  'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ItemInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemInfo model.
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
     * Creates a new ItemInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemInfo();

        if ($model->load(Yii::$app->request->post())) {
			$model->chef_user_id=Yii::$app->user->id;
			
			$folder_name='item_images';
			$user_id=Yii::$app->user->id;
			$media_path_array = UploadedFile::getInstances($model, 'image');
			if($media_path_array!=null){
				$old_file_name=$model->image;
				$new_file_array=$media_path_array;
				$new_uploaded_file_name_array=Mediaopration::Multipleupload($new_file_array,$folder_name,$user_id);
				if($new_uploaded_file_name_array!=null){					
				    foreach($new_uploaded_file_name_array as $new_uploaded_file){							
						$model->image=$new_uploaded_file['media_name'];
						$model->save();							
					}						
					return $this->redirect(['index']);
				}
			}

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
     * Updates an existing ItemInfo model.
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

	public function actionMakeitemlive($id)
    {
        $model = $this->findModel($id);
		$oldstatus=$model->status;
		if($oldstatus){
			$newstatus=0;
		}else{
			$newstatus=1;
		}
		
		$model->status=$newstatus;
		if ($model->save()) {
			return $this->redirect(['index']);
		}
    }

    /**
     * Deletes an existing ItemInfo model.
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
     * Finds the ItemInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
