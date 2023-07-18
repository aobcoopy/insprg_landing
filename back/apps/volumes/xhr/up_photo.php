<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
		$save_dir = "../../../../uploads/Volums/";
		if(!file_exists($save_dir))
		{
			mkdir($save_dir);
		}
		
		
		
		//check type file
		$allowed =  array('gif','png','PNG','jpg');
		$filename = $_FILES['file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			echo 'file is not supported';
		}
		else
		{
			$times = time(' H:i:s');
			//$picName = date('Y-m-d').$times.".jpg";
			//$picName = 'photo_'.$times.".jpg";
			
			$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
	
			$new_images = "Volums_".$newfilename;
		
			$save_path = "$save_dir/$new_images";
			if(move_uploaded_file($_FILES["file"]["tmp_name"],$save_dir.'/'.$new_images))
			{
				$save_dir = "/uploads/Volums";
				$location = $save_dir.'/'.$new_images;
				//echo $location;
				echo json_encode(array(
					'success'=>true,
					'path' => $location
				));
			}
			
			/*$times = time(' H:i:s');
			//$picName = date('Y-m-d').$times.".jpg";
			$picName = 'photo_'.$times.".jpg";
			$save_path = "$save_dir/$picName" ;
			if(move_uploaded_file($_FILES["file"]["tmp_name"],$save_dir.'/'.$picName))
			{
				$save_dir = "/upload/slide";
				$location = $save_dir.'/'.$picName;
				//echo $location;
				echo json_encode(array(
					'success'=>true,
					'path' => $location
				));
				
			}*/
		}
		
		$dbc->Close();
		
?>