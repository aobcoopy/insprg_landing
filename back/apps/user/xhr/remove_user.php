<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	foreach($_REQUEST['items'] as $item){
		$users = $dbc->GetRecord("users","*","id = '".$item."'");
		if($users['super']=='')
		{
			$dbc->Delete("contacts","id='".$users['contact']."'");
			$dbc->Delete("users","id=".$item);
			
			echo json_encode(array(
				'success'=>true,
				'msg'=> 'Success'
			));
		}
		else
		{
			/*echo json_encode(array(
				'success'=>false,
				'msg'=> "Don't remove this account."
			));*/
		}
		
	}
	
	
	
	$dbc->Close();
?>