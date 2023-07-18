<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	if(unlink('../../../../'.$_POST['path']))
	{
		echo json_encode(
			array(
				'status' => true,
				'msg' => 'ดำเนินการเรียบร้อย'
			)
		);
	}
	else
	{
		echo json_encode(
			array(
				'status' => false,
				'msg' => 'ไม่สามารถลบไฟล์ได้ กรุณาลองใหม่อีกครั้ง'
			)
		);

	}
	$dbc->Close();
?>
