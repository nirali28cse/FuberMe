<?php

namespace app\controllers;

use Yii;
use app\models\ItemInfo;
use app\models\ItemInfoSearch;
use app\models\ItemInfoLiveSearch;
use app\models\ItemInfoOfflineSearch;
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

	
	public function beforeAction($event)
    {
        
		$before_login_action=array();
		$after_login_action=array();
		$before_login_action=array('conhome','view');

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
		if(Yii::$app->user->identity->is_admin==1){
			$searchModel = new ItemInfoSearch();
			$searchModel->status = 1;	
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

			return $this->render('index2', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
    }
	
  
	
  public function actionConhome()
    {
		$this->layout = '/fuber_me/customerhome';
	//	session_start();
		
	//	unset($_SESSION['filetrsarray']);

		$old_cusion_array=array();
		$old_dieta_array=array();
		$old_categ_array=array();
		$old_delivery_array=array();
		
		if(isset($_SESSION['filetrsarray']['cusion_array']) and $_SESSION['filetrsarray']['cusion_array']!=null){
			$old_cusion_array=$_SESSION['filetrsarray']['cusion_array'];
		}
		
		if(isset($_SESSION['filetrsarray']['dieta_array']) and $_SESSION['filetrsarray']['dieta_array']!=null){
			$old_dieta_array=$_SESSION['filetrsarray']['dieta_array'];
		}	
		
		if(isset($_SESSION['filetrsarray']['categ_array']) and $_SESSION['filetrsarray']['categ_array']!=null){
			$old_categ_array=$_SESSION['filetrsarray']['categ_array'];
		}		

		if(isset($_SESSION['filetrsarray']['delivery_array']) and $_SESSION['filetrsarray']['delivery_array']!=null){
		//	if($_SESSION['filetrsarray']['delivery_array'][0]!='both'){
				$old_delivery_array=$_SESSION['filetrsarray']['delivery_array'];	
		//	}			
		}
		
		$min_price=0;
		$max_price=0;		
		if(isset($_SESSION['filetrsarray']['min_price']) and $_SESSION['filetrsarray']['min_price']>=0){
			$min_price=$_SESSION['filetrsarray']['min_price'];
		}	
		if(isset($_SESSION['filetrsarray']['max_price']) and $_SESSION['filetrsarray']['max_price']>=0){
			$max_price=$_SESSION['filetrsarray']['max_price'];
		}	

		
		
		unset($_SESSION['filetrsarray']);


		$new_cusion_array=array();		
		$new_dieta_array=array();
		$new_categ_array=array();
		$new_delivery_array=array();	
	
		if(isset($_GET['cusion']) and $_GET['cusion']>0){			
			if(!in_array($_GET['cusion'],$old_cusion_array)){
			  $new_cusion_array[$_GET['cusion']]=$_GET['cusion'];
			}
		}	
		if(isset($_GET['dieta']) and $_GET['dieta']>0){
			if(!in_array($_GET['dieta'],$old_dieta_array)){
				$new_dieta_array[$_GET['dieta']]=$_GET['dieta'];
			}
		}	
		if(isset($_GET['categ']) and $_GET['categ']>0){
			if(!in_array($_GET['categ'],$old_categ_array)){
				$new_categ_array[$_GET['categ']]=$_GET['categ'];	
			}
		}	
		if(isset($_GET['delivery']) and $_GET['delivery']!=null){
			if(!in_array($_GET['delivery'],$old_delivery_array)){
				$new_delivery_array[0]='both';
				$new_delivery_array[1]=$_GET['delivery'];			
			}
		}	


		$cusion_array=array();		
		$dieta_array=array();
		$categ_array=array();
		$delivery_array=array();
		
		$cusion_array=array_merge($old_cusion_array,$new_cusion_array);		
		$dieta_array=array_merge($old_dieta_array,$new_dieta_array);		
		$categ_array=array_merge($old_categ_array,$new_categ_array);		
		$delivery_array=array_merge($old_delivery_array,$new_delivery_array);		

		if(isset($_GET['dacateg']) and $_GET['dacateg']==1){
			unset($categ_array);
			$categ_array=array();
		}
		
		if(isset($_GET['dacusion']) and $_GET['dacusion']==1){
			unset($cusion_array);
			$cusion_array=array();
		}
		
		if(isset($_GET['dcusion']) and in_array($_GET['dcusion'],$cusion_array)){
			if (($key = array_search($_GET['dcusion'], $cusion_array)) !== false) {
				unset($cusion_array[$key]);
			}
		}			
		
		if(isset($_GET['ddieta']) and in_array($_GET['ddieta'],$dieta_array)){
			if (($key = array_search($_GET['ddieta'], $dieta_array)) !== false) {
				unset($dieta_array[$key]);				
			}
		}	
		
		if(isset($_GET['dcateg']) and in_array($_GET['dcateg'],$categ_array)){
			if (($key = array_search($_GET['dcateg'], $categ_array)) !== false) {
				unset($categ_array[$key]);
			}
		}	
				
		if(isset($_GET['ddelivery']) and in_array($_GET['ddelivery'],$delivery_array)){
			if (($key = array_search($_GET['ddelivery'], $delivery_array)) !== false) {
				unset($delivery_array[$key]);

				if(isset($delivery_array) and $delivery_array!=null){
					if(count($delivery_array)==1){
						$delivery_array=array();
					}			
				}
			}
		}	
		

		
		if(isset($_GET['min_price']) and $_GET['min_price']>=0){
			$min_price=$_GET['min_price'];
		}	
		if(isset($_GET['max_price']) and $_GET['max_price']>=0){
			$max_price=$_GET['max_price'];
		}	
		
				
		$min_location=0;
		$max_location=0;	
		$chef_array=array();	
		$chef_distance_array=array();
		
		
		//Chef array from delivery type

/* 		*/

		// get the all chef  locations latitude and longitude from zip code
		if($delivery_array!=null){
			$allchef_info = Userdetail::find()
			 ->where(['status'=>1])
			 ->ANDwhere(['or','user_type=2','user_type=3'])
			 ->ANDwhere(['in','delivery_method',$delivery_array])
			 ->all();

			 if(count($allchef_info)>0){
					$min_location=1;
					$max_location=1;
				foreach($allchef_info as $allchef){
					$chef_id=$allchef->id;
					$chef_array[]=$chef_id;	
				}
			 }
		}
	 
				 
		
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
			 
			//  $PublicIP = '103.66.114.146'; 
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
							$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=true&key=AIzaSyCFC5eV1WfHcUixc5F96FmlvvfoPHdOAnk";
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
				//	echo $chef_distance=distance($my_latitude,$chef_latitude,$my_longitude,$chef_longitude, "M"); 
				//	echo '<br/>';
					if($chef_distance>=$min_location and $chef_distance<=$max_location){
						$chef_array[]=$chef_id;	
					}					
				}
			}
				
		}	


		$search_by_item=null;

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
						$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=true&key=AIzaSyCFC5eV1WfHcUixc5F96FmlvvfoPHdOAnk";
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
			
		/* 	$allchef_info = Userdetail::find()->where(['status'=>1])
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

			}else{ */
			
			
				$location_distance_array=array();	
				$equal_distance_array=array();
				$less_distance_array=array();
				$greter_distance_array=array();
				
				$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$search_by_location."&sensor=true&key=AIzaSyCFC5eV1WfHcUixc5F96FmlvvfoPHdOAnk";
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
						

				//	$location_distance_array[0]=array('chef_latitude'=>$chef_latitude,'chef_longitude'=>$chef_longitude);	

					$location_latitude=$chef_latitude;
					$location_longitude=$chef_longitude;
					
					$location_distance_array[0]=distance($location_latitude,$chef_latitude,$location_longitude,$chef_longitude, "M"); 

					
					if($chef_distance_array!=null){
						foreach($chef_distance_array as $chef_id=>$chef_distance){
							$chef_latitude=$chef_distance['chef_latitude'];
							$chef_longitude=$chef_distance['chef_longitude'];					
							$location_distance_array[$chef_id]=distance($location_latitude,$chef_latitude,$location_longitude,$chef_longitude, "M"); 
						}
					}
					
					$search_loca_dist=0;


					$new_chef_array=array();
					if($location_distance_array!=null){				
						echo $search_loca_dist=$location_distance_array[0];
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
					$min_location=1;
					$max_location=1;
						
				}

		//	}

		}

/*  echo '<pre>';
print_r($chef_array);
print_r($location_distance_array);
print_r($equal_distance_array);
print_r($less_distance_array);
print_r($greter_distance_array);
print_r($result);
exit;  */

		if($search_by_item!=null or $cusion_array!=null or $dieta_array!=null or $delivery_array!=null or $categ_array!=null or $min_price>0 or $max_location>0 or $min_location>0 or $max_price>0){
			$_SESSION['filetrsarray']=array(
										'min_price'=>$min_price,
										'max_price'=>$max_price,
										'min_location'=>$min_location,
										'max_location'=>$max_location,
										'chef_array'=>$chef_array,
										'cusion_array'=>$cusion_array,
										'dieta_array'=>$dieta_array,
										'categ_array'=>$categ_array,
										'delivery_array'=>$delivery_array,
										'search_by_item'=>$search_by_item,
										);
										
/* echo '<pre>';
		print_r($old_delivery_array);
		print_r($new_delivery_array);
		print_r($_SESSION['filetrsarray']);
		exit;  */
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
			return $this->renderAjax('conhomeitem', [
					'livedataProvider' => $livedataProvider,
					'offlinedataProvider' => $offlinedataProvider,
				]);
		}else{
			return $this->render('Conhome', [
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
	
		$model=$this->findModel($id);

		//update offline live items
		$alloffline_liveitems = ItemInfo::find()
		 ->where(['AND',
				['<=', 'availability_from_date',Yii::$app->params['today_date']],
				['<=', 'availability_to_date',Yii::$app->params['today_date']],
				['status'=>1]
				])
		 ->all();

		if(count($alloffline_liveitems)>0){
			$update_itemid_array=array();
			foreach($alloffline_liveitems as $alloffline_liveitem){
				$update_itemid_array[]=$alloffline_liveitem->id;
			}

			if($update_itemid_array!=null){
				$update_item=ItemInfo::updateAll( 
					 array('status' =>0),['id' =>  $update_itemid_array]
				);
			}

		}		
		//update offline live items
		
		if($model->chef_user_id>0){
			$chef_array[]=$model->chef_user_id;
			if($chef_array!=null){
				$_SESSION['filetrsarray']=array(
											'min_location'=>1,
											'max_location'=>1,
											'chef_array'=>$chef_array,
											'search_by_item'=>null,
											'min_price'=>0,
											'max_price'=>0,
											'cusion_array'=>array(),
											'dieta_array'=>array(),
											'categ_array'=>array(),
											);
			}
		}

		
		$livesearchModel = new ItemInfoLiveSearch(); 
		$livedataProvider = $livesearchModel->search(Yii::$app->request->queryParams); 
				
		$offlinesearchModel = new ItemInfoOfflineSearch(); 
		$offlinedataProvider = $offlinesearchModel->search(Yii::$app->request->queryParams); 


		return $this->render('view', [
			'model' => $model,
			'livedataProvider' => $livedataProvider,
			'offlinedataProvider' => $offlinedataProvider,
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
		$model->setScenario('create');
        if ($model->load(Yii::$app->request->post())) {
			$model->chef_user_id=Yii::$app->user->id;
			
			$folder_name='item_images';
			$user_id=Yii::$app->user->id;
			

			
			// image upload		

			$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
			$max_file_size = $_FILES['ItemInfo']['size']['image']; #200kb
			$nw = 350;# image with # height			
			$nh = 250; 							
			if ( isset($_FILES['ItemInfo']) ) {
				if (! $_FILES['ItemInfo']['error']['image'] && $_FILES['ItemInfo']['size']['image'] <= $max_file_size) {
						
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
						
					$ext = strtolower(pathinfo($_FILES['ItemInfo']['name']['image'], PATHINFO_EXTENSION));
					if (in_array($ext, $valid_exts)) {
							$image_name=Yii::$app->security->generateRandomString(). '.' . $ext;
							$path = Yii::$app->basePath.'/web/fuberme/'.$user_id.'/'.$folder_name.'/'.$image_name;
							$size = getimagesize($_FILES['ItemInfo']['tmp_name']['image']);

							$x = (int) $_POST['x'];
							$y = (int) $_POST['y'];
							$w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
							$h = (int) $_POST['h'] ? $_POST['h'] : $size[1];

							$data = file_get_contents($_FILES['ItemInfo']['tmp_name']['image']);
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
			
			$availability_from_date = strtotime($_POST['ItemInfo']['availability_from_date']);
			$availability_to_date = strtotime($_POST['ItemInfo']['availability_to_date']);
			$todays_date = strtotime(Yii::$app->params['today_date']);
			
			if ($availability_from_date <= $todays_date and $availability_to_date >= $todays_date) { 
				$model->status=1;
				$status=1;
			}	
			elseif ($availability_from_date >= $todays_date or $availability_to_date <= $todays_date) { 
				$model->status=0;
				$status=0;
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
		$old_file_name=$model->image;
		
        if ($model->load(Yii::$app->request->post())) {
			$model->chef_user_id=Yii::$app->user->id;

			$folder_name='item_images';
			$user_id=Yii::$app->user->id;

			// image upload			
			$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
			$max_file_size =$_FILES['ItemInfo']['size']['image']; //  200 * 1024; #200kb
			$nw = 350;# image with # height			
			$nh = 250; 

			if ( isset($_FILES['ItemInfo']) ) {
				if (! $_FILES['ItemInfo']['error']['image'] &&  $_FILES['ItemInfo']['size']['image'] <= $max_file_size) {
					
						
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
						

					
					$ext = strtolower(pathinfo($_FILES['ItemInfo']['name']['image'] , PATHINFO_EXTENSION));
					if (in_array($ext, $valid_exts)) {
							$image_name=Yii::$app->security->generateRandomString(). '.' . $ext;
							$path = Yii::$app->basePath.'/web/fuberme/'.$user_id.'/'.$folder_name.'/'.$image_name;
							$size = getimagesize($_FILES['ItemInfo']['tmp_name']['image']);

							$x = (int) $_POST['x'];
							$y = (int) $_POST['y'];
							$w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
							$h = (int) $_POST['h'] ? $_POST['h'] : $size[1];

/* 							$percent = 0.5;

							$nw = $size[0] * $percent;
							$nh = $size[1] * $percent; */

							$data = file_get_contents($_FILES['ItemInfo']['tmp_name']['image']);
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
			

			$availability_from_date = strtotime($_POST['ItemInfo']['availability_from_date']);
			$availability_to_date = strtotime($_POST['ItemInfo']['availability_to_date']);
			$todays_date = strtotime(Yii::$app->params['today_date']);
			
			if ($availability_from_date <= $todays_date and $availability_to_date >= $todays_date) { 
				$model->status=1;
			}	
			elseif ($availability_from_date >= $todays_date or $availability_to_date <= $todays_date) { 
				$model->status=0;
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
			$model->availability_from_date=Yii::$app->params['today_date'];
			$model->availability_from_time=$newTime;
			$newstatus=1;
		}else{
		//	$newstatus=1;
			$model->availability_to_date=Yii::$app->params['today_date'];
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
		if(!Yii::$app->user->isGuest){
			if(Yii::$app->user->identity->is_admin==1){
				$model = ItemInfo::findOne($id);
			}else{
				$model = ItemInfo::find()->where([
					'id'=>$id,
				//	'chef_user_id'=>Yii::$app->user->id,
					])->one();
			}

		}else{
			$model = ItemInfo::find()->where([
					'id'=>$id,
				//	'chef_user_id'=>Yii::$app->user->id,
					])->one();
		}
		
					
		if (($model) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		
			
    }
}
