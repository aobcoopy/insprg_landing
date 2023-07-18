<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	foreach($_REQUEST['items'] as $item){
		$pho = $dbc->GetRecord("articles","*","id = '".$item."'");
		unlink('../../../../'.json_decode($pho['files'],true));
		$dbc->Delete("articles","id='".$pho['id']."'");
		
			
	}
	
	echo json_encode(array(
			'success'=>true,
			'msg'=> 'Success'
		));
	$dbc->Close();
?>