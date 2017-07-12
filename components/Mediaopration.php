<?php

namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use app\models\ItemInfo;


class Mediaopration extends Component
{

	 public static function Updateitemstatus()
	 {

		$alloffline_liveitems = ItemInfo::find()->all();

		if(count($alloffline_liveitems)>0){
			
			$update_itemto_live=array();
			$update_itemto_offline=array();
			foreach($alloffline_liveitems as $model){
				
					$newdate =Yii::$app->params['today_date'];
					$newdates = strtotime($newdate);
					$availability_to_date = strtotime($model->availability_to_date);
					$availability_from_date = strtotime($model->availability_from_date);
					$newhours = date("H");
					$newminiute = date("i");		
					$newTime = $newhours.':'.$newminiute;
					$newTime = strtotime($newTime); 
					$availability_from_time = strtotime($model->availability_from_time); 
					$availability_to_time = strtotime($model->availability_to_time); 
					
					$display_offline=0;
					if($availability_from_date<=$newdates and $newdates<=$availability_to_date){
						if($availability_from_date!=$newdates and $newdates!=$availability_to_date){
							$display_offline=1;
						}elseif($availability_from_date==$newdates and $newdates!=$availability_to_date){
							$display_offline=1;
						}else{
							if($availability_from_date==$newdates and ($newTime>=$availability_from_time and $availability_to_time>=$newTime)){
								$display_offline=1;
							}
							if($availability_to_date==$newdates and $newTime>=$availability_from_time and $availability_to_time>=$newTime){
								$display_offline=1;
							}
						}
					}
					
					$item_is_live=0;
					$item_is_offline=0;
					$item_status=0;
					if($display_offline==1){  
						$item_is_live=1;
					}else{
						$item_is_offline=1;
					}
					
					$item_status=$model->status;

					if($item_status==0 and $item_is_offline==1){
					}elseif($item_status==1 and $item_is_live==1){
					}elseif($item_status==0 and $item_is_live==1){
						$update_itemto_live[]=$model->id;
					}elseif($item_status==1 and $item_is_offline==1){
						$update_itemto_offline[]=$model->id;
					}

			}

			if($update_itemto_live!=null){
				$update_item=ItemInfo::updateAll( 
					 array('status' =>1),['id' =>  $update_itemto_live]
				);
			}
			
			if($update_itemto_offline!=null){
				$update_item=ItemInfo::updateAll( 
					 array('status' =>0),['id' =>  $update_itemto_offline]
				);
			}

		}	
	 
	 }	
	 
	 
	 public static function Getuserfolderpath($user_id)
	 {

			$user_path = Yii::$app->basePath.'/web/fuberme/'.$user_id;			
			return $user_path;
	 }	

	 public static function Getfolderpath($user_path,$folder_name)
	 {
			$folder_path = $user_path.'/'.$folder_name;			
			return $folder_path;
	 }
	 
	 
	 public static function Upload($old_file_name,$new_file_array,$folder_name,$user_id)
	 {

			$return_success=0;
			$user_path = self::Getuserfolderpath($user_id);
			$folder_path = self::Getfolderpath($user_path,$folder_name); 
			
			// upload or update new image
			if($new_file_array!=null){
				$ext = end((explode(".", $new_file_array->name)));
				// generate a unique file name
				$new_uploaded_file_name=Yii::$app->security->generateRandomString().".{$ext}";

				if ($user_path && ! file_exists($user_path))
				{
					mkdir($user_path, 0755, true);	
				} 
				
				if ($folder_path && ! file_exists($folder_path))
				{
					mkdir($folder_path, 0755, true);
				} 	
				
					
				if ($folder_path && file_exists($folder_path))
				{
					$upload_folder_path =$folder_path.'/'.$new_uploaded_file_name;
					if($new_file_array->saveAs($upload_folder_path)){						
						$return_success=1;
					}
				} 
			}

			// remove old image
			if(($old_file_name!=null) and ($new_file_array!=null)){	
				if(self::Delete($old_file_name,$folder_name,$user_id)){
					// $return_success=1;
				}
			}

			
			if($return_success==1){
				return $new_uploaded_file_name;
			}else{
				return '0';
			}

	 }
	 
	 
	 
	 public static function Delete($delete_file_name,$folder_name,$user_id)
	 {

			$user_path = self::Getuserfolderpath($user_id);
			$folder_path = self::Getfolderpath($user_path,$folder_name); 
	 		$delete_path=$folder_path.'/'.$delete_file_name;
	
			if (file_exists($delete_path)) {
				if (unlink($delete_path)) {
					return true;
				}else{
					return false;
				}
			}
	 }
	 
	 

	public static function Multipleupload($new_file_array1,$folder_name,$user_id)
	 {

			$return_success=0;
			$new_uploaded_file_name_array=array();
			
			$user_path = self::Getuserfolderpath($user_id);
			$folder_path = self::Getfolderpath($user_path,$folder_name); 
			
			// upload or update new image
			if($new_file_array1!=null){
				
				 $i=1;
				 foreach ($new_file_array1 as $new_file_array) {
	 
					$ext = end((explode(".", $new_file_array->name)));
					// generate a unique file name
					$new_uploaded_file_name=Yii::$app->security->generateRandomString().".{$ext}";

					if ($user_path && ! file_exists($user_path))
					{
						mkdir($user_path, 0755, true);	
					} 
					
					if ($folder_path && ! file_exists($folder_path))
					{
						mkdir($folder_path, 0755, true);
					} 	
					
						
					if ($folder_path && file_exists($folder_path))
					{
						$upload_folder_path =$folder_path.'/'.$new_uploaded_file_name;
						if($new_file_array->saveAs($upload_folder_path)){						
							$return_success=1;
						}
					} 

					if($return_success==1){
							$new_uploaded_file_name_array[$i]['media_name']=$new_uploaded_file_name;
							$new_uploaded_file_name_array[$i]['media_size']=$new_file_array->size;
							$new_uploaded_file_name_array[$i]['media_type']=$new_file_array->type;
					}
					
					$i++;
				}
				
			}
				
			return $new_uploaded_file_name_array;
			

	 }
	 
	 
	 
	public static function distance($lat1, $lon1, $lat2, $lon2, $unit) {

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

 
	 public static function search_by_geolocation($search_by_location,$allchef_info)
	 {
		 $chef_distance_array=array();	
		 $chef_array=array();	
		 
		 if(count($allchef_info)>0){
			foreach($allchef_info as $allchef){
				$zipcode=$allchef->zipcode;
				$chef_id=$allchef->id;
				if($zipcode>0 and $zipcode!=null){				
					
					$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&key=".Yii::$app->params['geo_location_api_fey'];
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
		 
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$search_by_location."&key=".Yii::$app->params['geo_location_api_fey'];
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
			$location_distance_array[0]=self::distance($chef_latitude,$chef_latitude,$chef_longitude,$chef_longitude, "M"); 

			$location_latitude=$chef_latitude;
			$location_longitude=$chef_longitude;
			
			
			if($chef_distance_array!=null){
				foreach($chef_distance_array as $chef_id=>$chef_distance){
					$chef_latitude=$chef_distance['chef_latitude'];
					$chef_longitude=$chef_distance['chef_longitude'];					
					$location_distance_array[$chef_id]=self::distance($location_latitude,$chef_latitude,$location_longitude,$chef_longitude, "M"); 
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
		

		return $chef_array;
		 
		 
	 }
	 

}

   
?>