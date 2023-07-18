<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['tx_Name'],
			'photo' => json_encode($_REQUEST['txt_photo']),
			'files' => json_encode($_REQUEST['txt_pdf']),
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			'#status' => '0',
			'#user' => $_SESSION['auth']['user_id']
		);
		
		if($dbc->Insert("article_volumes",$data)){
			$id = $dbc->GetID();
				
			echo json_encode(array(
				'success'=>true,
				'msg'=> 'Success'
			));
		}
		else
		{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Please try again"
			));
		}
	$dbc->Close();
?>