<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$pho = $dbc->GetRecord("articles","*","id='".$_REQUEST['txtID']."'");
	$file_new = $_REQUEST['tx_E_photo'];
	//$file_old = json_decode($pho['files'],true);
		
	if($file_new!='')
	{
		unlink('../../../../'.json_decode($pho['files'],true));
		$data = array(
			'name' => $_REQUEST['tx_E_Name'],
			'detail' => $_REQUEST['tx_E_Detail'],
			'files' => json_encode($_REQUEST['tx_E_photo']),
			'#updated' => 'NOW()',
			'#status' => '0',
			'#volumes' => $_REQUEST['cbb_E_Volume'],
			'#user' => $_SESSION['auth']['user_id']
		);
	}
	else
	{
		$data = array(
			'name' => $_REQUEST['tx_E_Name'],
			'detail' => $_REQUEST['tx_E_Detail'],
			//'files' => json_encode($_REQUEST['tx_E_photo']),
			'#updated' => 'NOW()',
			'#status' => '0',
			'#volumes' => $_REQUEST['cbb_E_Volume'],
			'#user' => $_SESSION['auth']['user_id']
		);
	}
		
	
		
		
		
		
		if($dbc->Update("articles",$data,"id='".$_REQUEST['txtID']."'")){
				
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