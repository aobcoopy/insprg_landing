<?php 
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	include_once "../class/minerva.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new minerva($dbc);

	if($dbc->HasRecord("subscribe","email = '".$_REQUEST['email']."' "))
	{
		echo json_encode(
			array(
				'status' => false,
				'msg' => 'Email is already'
			)
		);
	}
	else
	{
	
		$data = array(
			'id' => 'DEFAULT',
			'email' => $_REQUEST['email'],
			'#created' => 'NOW()',
			'#status' => '0'
		);
		
		if($dbc->Insert("subscribe",$data))
		{
			echo json_encode(
				array(
					'status' => true,
					'msg' => 'Success full'
				)
			);
		}
		else
		{
			echo json_encode(
				array(
					'status' => false,
					'msg' => 'Please try again'
				)
			);
		}
	}
?>