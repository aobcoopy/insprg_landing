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
			'detail' => $_REQUEST['tx_Detail'],
			'files' => json_encode($_REQUEST['txt_photo']),
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			'#status' => '0',
			'#volumes' => $_REQUEST['cbbVolume'],
			'#user' => $_SESSION['auth']['user_id']
		);
		
		if($dbc->Insert("articles",$data)){
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