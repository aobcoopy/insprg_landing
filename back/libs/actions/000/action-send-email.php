<?php 
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	include_once "../class/minerva.php";
    include_once "../../inc/sendmail.inc.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new minerva($dbc);


	
	$strTo = $_REQUEST['txemail'].",aobcoopy@gmail.com";
	$strSubject = "Blog & Liftstyle";
	$strHeader = "From: info@inspiringvillas.com";
	$strMessage = "Share Blog";
	$flgSend = newSendMail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	
	
	
	if($flgSend)
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
?>