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
use yii\data\ActiveDataProvider;
use app\modules\users\models\Userdetail;

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
		$searchModel->status = 1;	
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    public function actionConhome()
    {
		session_start();
		unset($_SESSION['filetrsarray']);
		$price=0;
		$cusion=0;
		$dieta=0;
		$location=0;
		

		
		if(isset($_GET['price']) and $_GET['price']>0){
			$price=$_GET['price'];
		}		
		if(isset($_GET['cusion']) and $_GET['cusion']>0){
			$cusion=$_GET['cusion'];
		}	
		if(isset($_GET['dieta']) and $_GET['dieta']>0){
			$dieta=$_GET['dieta'];
		}	
		if(isset($_GET['location']) and $_GET['location']>0){
			$location=$_GET['location'];
		}
		
		if(isset($_GET['dlocation']) and $_GET['dlocation']==1){
			$location=0;
		}	
		
		if(isset($_GET['ddieta']) and $_GET['ddieta']==1){
			$dieta=0;
		}		
				
		if(isset($_GET['dcusion']) and $_GET['dcusion']==1){
			$cusion=0;
		}		
		
		if(isset($_GET['dprice']) and $_GET['dprice']==1){
			$price=0;
		}
		
		
		$min_price=0;
		$max_price=0;		
		if(isset($_GET['min_price']) and $_GET['min_price']>0){
			$min_price=$_GET['min_price'];
		}	
		if(isset($_GET['max_price']) and $_GET['max_price']>0){
			$max_price=$_GET['max_price'];
		}	
		
				
		$min_location=0;
		$max_location=0;	
		$chef_array=array();	
		$chef_distance_array=array();
		
		if(isset($_GET['min_location']) and $_GET['min_location']>0){
			$min_location=$_GET['min_location'];
		}	
		if(isset($_GET['max_location']) and $_GET['max_location']>0){
			$max_location=$_GET['max_location'];
				
			// get the user locations latitude and longitude
			 function get_client_ip() {
					$ipaddress = '';
					if (isset($_SERVER['HTTP_CLIENT_IP']))
						$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
					else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
						$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
					else if(isset($_SERVER['HTTP_X_FORWARDED']))
						$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
					else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
						$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
					else if(isset($_SERVER['HTTP_FORWARDED']))
						$ipaddress = $_SERVER['HTTP_FORWARDED'];
					else if(isset($_SERVER['REMOTE_ADDR']))
						$ipaddress = $_SERVER['REMOTE_ADDR'];
					else
						$ipaddress = 'UNKNOWN';
					return $ipaddress;
				}
			 $PublicIP = get_client_ip(); 
			 
			 $PublicIP = '103.66.114.146'; 
			 $json  = file_get_contents("https://freegeoip.net/json/$PublicIP");
			 $json  =  json_decode($json ,true);
			 $my_latitude= $json['latitude'];
			 $my_longitude= $json['longitude'];

			 // get the all chef  locations latitude and longitude from zip code
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

			// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>"; 
			// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
			// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";
			// echo distance($my_latitude,$chef_latitude,$my_longitude,$chef_longitude, "M") . " Miles<br>"; 
			
			if($chef_distance_array!=null){
				foreach($chef_distance_array as $chef_id=>$chef_distance){
					$chef_latitude=$chef_distance['chef_latitude'];
					$chef_longitude=$chef_distance['chef_longitude'];					
					$chef_distance=0;
					$chef_distance=distance($my_latitude,$chef_latitude,$my_longitude,$chef_longitude, "M"); 
					if($chef_distance<=$max_location){
						$chef_array[]=$chef_id;	
					}					
				}
			}
				
		}	
		
/* echo '<pre>';
print_r($chef_array);
print_r($chef_distance_array); */

		
		if($cusion>0 or $price>0 or $location>0 or $dieta>0 or $min_price>0 or $max_location>0 or $min_location>0 or $max_price>0){
			$_SESSION['filetrsarray']=array('price'=>$price,'cusion'=>$cusion,
										'min_price'=>$min_price,'max_price'=>$max_price,
			'min_location'=>$min_location,'max_location'=>$max_location,'chef_array'=>$chef_array,
										'location'=>$location,'dieta'=>$dieta);
		}

/*         $searchModel = new ItemInfoSearch();
		$searchModel->status=1;	
		$_GET['liveitem']=1;			
        $livedataProvider = $searchModel->search(Yii::$app->request->queryParams);
 */
 
 

        $searchModel = new ItemInfoSearch();
		$searchModel->status=0;	
	//	$_GET['offlineitem']=1;			
	//	$_GET['liveitem']=0;			
        $offlinedataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$searchModel->status=1;	
	//	$_GET['liveitem']=1;	
	//	$_GET['offlineitem']=0;				
        $livedataProvider = $searchModel->search(Yii::$app->request->queryParams);
	//	$models  = $livedataProvider->getModels();

	
	
	
	
	
		if (Yii::$app->request->isAjax){
			return $this->renderAjax('conhomeitem', [
					'searchModel' => $searchModel,
					'livedataProvider' => $livedataProvider,
					'offlinedataProvider' => $offlinedataProvider,
				]);
		}else{
			return $this->render('Conhome', [
				'searchModel' => $searchModel,
				'livedataProvider' => $livedataProvider,
				'offlinedataProvider' => $offlinedataProvider,
			]);
		}
		

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
		
		// live
		if($newstatus){
		//	$newstatus=0;
			$model->availability_from_date=date('Y-m-d');
			$model->availability_from_time=$newTime;
			$newstatus=1;
		}else{
		//	$newstatus=1;
			$model->availability_to_date=date('Y-m-d');
			$model->availability_to_time=$newTime;
			$newstatus=0;
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
				<h4 class="modal-title" id="myModalLabel">Select End Date and Time</h4>
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
