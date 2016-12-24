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
use yii\helpers\Url;
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
		if(Yii::$app->user->identity->is_admin!=1){
		 $searchModel->chef_user_id = Yii::$app->user->id;	
		}
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
    public function actionIndex2()
    {
        $searchModel = new ItemInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index2', [
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
			
			
			
			// image upload			
			$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
			$max_file_size = $_FILES['image']['size']; #200kb
			$nw = 350;# image with # height			
			$nh = 250; 							
			if ( isset($_FILES['image']) ) {
				if (! $_FILES['image']['error'] && $_FILES['image']['size'] <= $max_file_size) {
						
					$user_path = Yii::$app->basePath.'/web/fuberme/'.$user_id;		
					if ($user_path && ! file_exists($user_path))
					{
						mkdir($user_path, 0755, true);	
					} 
					$folder_path = $user_path.'/'.$folder_name;		
					if ($folder_path && ! file_exists($folder_path))
					{
						mkdir($folder_path, 0755, true);
					} 	
						
					$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
					if (in_array($ext, $valid_exts)) {
							$image_name=Yii::$app->security->generateRandomString(). '.' . $ext;
							$path = Yii::$app->basePath.'/web/fuberme/'.$user_id.'/'.$folder_name.'/'.$image_name;
							$size = getimagesize($_FILES['image']['tmp_name']);

							$x = (int) $_POST['x'];
							$y = (int) $_POST['y'];
							$w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
							$h = (int) $_POST['h'] ? $_POST['h'] : $size[1];

							$data = file_get_contents($_FILES['image']['tmp_name']);
							$vImg = imagecreatefromstring($data);
							$dstImg = imagecreatetruecolor($nw, $nh);
							imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
							imagejpeg($dstImg, $path);
							imagedestroy($dstImg);
						//	echo "<img src='$path' />";
							$model->image=$image_name;
							$model->save();		
							return $this->redirect(['index']);
							
						} else {
						//	echo 'unknown problem!';
						} 
				} else {
				//	echo 'file is too small or large';
				}
			}
			
			
			
/* 			$media_path_array = UploadedFile::getInstances($model, 'image');
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
			} */

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
		$old_file_name=$model->image;
		
        if ($model->load(Yii::$app->request->post())) {
			$model->chef_user_id=Yii::$app->user->id;

			$folder_name='item_images';
			$user_id=Yii::$app->user->id;
						
/* 			echo '<pre>';
			print_r($_FILES);
exit;			 */
			// image upload			
			$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
			$max_file_size =$_FILES['image']['size']; //  200 * 1024; #200kb
			$nw = 350;# image with # height			
			$nh = 250; 
			
			if ( isset($_FILES['image']) ) {
				if (! $_FILES['image']['error'] && $_FILES['image']['size'] <= $max_file_size) {
					
						
					$user_path = Yii::$app->basePath.'/web/fuberme/'.$user_id;		
					if ($user_path && ! file_exists($user_path))
					{
						mkdir($user_path, 0755, true);	
					} 
					$folder_path = $user_path.'/'.$folder_name;		
					if ($folder_path && ! file_exists($folder_path))
					{
						mkdir($folder_path, 0755, true);
					} 	
						

					
					$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
					if (in_array($ext, $valid_exts)) {
							$image_name=Yii::$app->security->generateRandomString(). '.' . $ext;
							$path = Yii::$app->basePath.'/web/fuberme/'.$user_id.'/'.$folder_name.'/'.$image_name;
							$size = getimagesize($_FILES['image']['tmp_name']);

							$x = (int) $_POST['x'];
							$y = (int) $_POST['y'];
							$w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
							$h = (int) $_POST['h'] ? $_POST['h'] : $size[1];

/* 							$percent = 0.5;

							$nw = $size[0] * $percent;
							$nh = $size[1] * $percent; */

							$data = file_get_contents($_FILES['image']['tmp_name']);
							$vImg = imagecreatefromstring($data);
							$dstImg = imagecreatetruecolor($nw, $nh);
							imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
							imagejpeg($dstImg, $path);
							imagedestroy($dstImg);
						//	echo "<img src='$path' />";
							$model->image=$image_name;
							$model->save();		
							if($old_file_name!=null){
								// delete old image upload
								$old_image_delete=Mediaopration::Delete($old_file_name,$folder_name,$user_id);	
							}							
							return $this->redirect(['index']);
							
						} else {
						//	echo 'unknown problem!';
						} 
				} else {
				//	echo 'file is too small or large';
				}
			}else{
				$model->image=$old_file_name;
			}
			
			
			
			
			
			
			
/* 			$media_path_array = UploadedFile::getInstances($model, 'image');

			// new image upload
			if($media_path_array!=null){				
				$new_file_array=$media_path_array;
				$new_uploaded_file_name_array=Mediaopration::Multipleupload($new_file_array,$folder_name,$user_id);
				if($new_uploaded_file_name_array!=null){					
				    foreach($new_uploaded_file_name_array as $new_uploaded_file){							
						$model->image=$new_uploaded_file['media_name'];
						$model->save();							
					}	
					
					// delete old image upload
					$old_image_delete=Mediaopration::Delete($old_file_name,$folder_name,$user_id);
					return $this->redirect(['index']);
				}
			}else{
				$model->image=$old_file_name;
			} */
			
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
	//	$oldstatus=$model->status;		
		$newstatus=$_GET['status'];	

		$newhours = date("H");
		$newminiute = date("i");		
		if($newminiute>=0 and $newminiute<=30) $newminiute = '00';
		if($newminiute>=30 and $newminiute<=60) $newminiute = 30;
		$newTime = $newhours.':'.$newminiute;
		
		if($newstatus){
		//	$newstatus=0;
			$model->availability_from_date=date('d-M-Y');
			$model->availability_from_time=$newTime;
		}else{
		//	$newstatus=1;
			$model->availability_to_date=date('d-M-Y');
			$model->availability_to_time=$newTime;
		}	
		
		if ($model->load(Yii::$app->request->post())) {
		}		
		$model->status=$newstatus;
		if ($model->save()) {
			return $this->redirect(['index']);
		}
    }
	
	
	public function actionGetenddate($id)
    {
		$model = $this->findModel($id);

		echo '
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Select End Date</h4>
			  </div>
			  <div class="modal-body">';
				return $this->renderAjax('get_enddate', [
					'model' => $model,
				]); 
		echo '</div>
			 
			';


	} 
	
	

    /**
     * Deletes an existing ItemInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$file_name=$model->image;
		$folder_name='item_images';
		$user_id=Yii::$app->user->id;			
		if($file_name!=null){
			$image_delete=Mediaopration::Delete($file_name,$folder_name,$user_id);
		}	

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
