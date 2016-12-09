<?php

namespace app\components;
 
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;



class Mediaopration extends Component
{

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
	 
	public static function Multipledelete($oldfile_delete_array,$folder_name,$user_id)
	 {
		 
	 }
	 

}

   
?>