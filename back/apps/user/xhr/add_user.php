<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$pass = $_REQUEST['tx_Password'];
	
	if(!$dbc->HasRecord("users","name = '".$_REQUEST['tx_Username']."'"))
	{
		$data = array(
			'#id' => "DEFAULT",
			'title' => $_REQUEST['cbbTitle'],
			'name' => $_REQUEST['tx_Firstname'],
			'surname' => $_REQUEST['tx_Lastname'],
			//'nickname' => $_REQUEST['txtNick'],
			//'dob' => $_REQUEST['txtDOB'],
			'gender' => $_REQUEST['cbbGender'],
			'email' => $_REQUEST['tx_Email'],
			'phone' => $_REQUEST['tx_Phone'],
			'mobile' => $_REQUEST['tx_Mobile'],
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'status' => 1
		);
		$dbc->Insert("contacts", $data);
		$contact_id = $dbc->GetID();
		
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['tx_Username'],
			'#password' => "PASSWORD('".$pass."')",
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			'#status' => '0',
			'#gid' => $_REQUEST['cbbGroup'],
			'contact' => $contact_id
			//'#user' => $_SESSION['auth']['user_id']
		);
		
		if($dbc->Insert("users",$data)){
			$id = $dbc->GetID();
				
			echo json_encode(array(
				'success'=>true,
				'msg'=> $id
			));
		}
	}
	else
	{
		echo json_encode(array(
			'success'=>false,
			'msg' => "Username is already"
		));
	}
	$dbc->Close();
?>