<?php

namespace app\controllers;

use Yii;
use app\models\ItemImages;
use app\models\ItemImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Mediaopration;
use yii\web\UploadedFile;
/**
 * ItemimagesController implements the CRUD actions for ItemImages model.
 */
class ItemimagesController extends Controller
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

    /**
     * Lists all ItemImages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemImages model.
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
     * Creates a new ItemImages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemImages();
       	if (Yii::$app->request->isPost) {
			
			$folder_name='item_images';
			$user_id=Yii::$app->user->id;
			$item_info_id=$_GET['iteminfoid'];
			
			if(isset($_POST['delete_images'])){
				 $item_images=ItemImages::find()->where(['item_info_id'=>$_GET['iteminfoid']])->all();
				 $user_path = Yii::$app->basePath.'/media_content/'.$user_id.'/'.$folder_name.'/';	
				 foreach($item_images as $item_image){
					// $images_array[]=$user_path.$item_image->image_path;	
					$old_file_name=null;
					$old_file_name=$item_image->image_path;
					$delete_images=Mediaopration::Delete($old_file_name,$folder_name,$user_id);
				 }
			}
			
			$media_path_array = UploadedFile::getInstances($model, 'image_path');
			if($media_path_array!=null){
				$old_file_name=$model->image_path;
				$new_file_array=$media_path_array;
				$new_uploaded_file_name_array=Mediaopration::Multipleupload($new_file_array,$folder_name,$user_id);
				if($new_uploaded_file_name_array!=null){
					
				    foreach($new_uploaded_file_name_array as $new_uploaded_file){							
						$model = new ItemImages();
						$model->item_info_id=$item_info_id;
						$model->image_path=$new_uploaded_file['media_name'];
						$model->media_type=$new_uploaded_file['media_type'];
						$model->media_size=$new_uploaded_file['media_size'];
						$model->save();							
					}						
					return $this->redirect(['index']);
				}
			}
		}else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
    }

    /**
     * Updates an existing ItemImages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ItemImages model.
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
     * Finds the ItemImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemImages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
