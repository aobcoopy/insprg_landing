<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$user = $_REQUEST['tx_E_Username'];
	$pass = $_REQUEST['tx_E_Password'];
	
	if($user!='')
	{
		if(!$dbc->HasRecord("customers","email = '".$_REQUEST['tx_E_Username']."'"))
		{
			$data = array(
				'title' => $_REQUEST['cbb_E_Title'],
				'name' => $_REQUEST['tx_E_Firstname'],
				'surname' => $_REQUEST['tx_E_Lastname'],
				//'nickname' => $_REQUEST['txtNick'],
				//'dob' => $_REQUEST['txtDOB'],
				'gender' => $_REQUEST['cbb_E_Gender'],
				'email' => $_REQUEST['tx_E_Email'],
				'phone' => $_REQUEST['tx_E_Phone'],
				'mobile' => $_REQUEST['tx_E_Mobile'],
				'#updated' => "NOW()",
			);
			$dbc->Update("contacts", $data,"id='".$_REQUEST['txtconID']."'");
			
			
			if($pass!='')
			{
				$data = array(
					'email' => $_REQUEST['tx_E_Username'],
					'#password' => "PASSWORD('".$pass."')",
					'#updated' => 'NOW()',
					//'#user' => $_SESSION['auth']['user_id']
				);
			}
			else
			{
				$data = array(
					'email' => $_REQUEST['tx_E_Username'],
					'#updated' => 'NOW()',
					//'#user' => $_SESSION['auth']['user_id']
				);
			}
			
			if($dbc->Update("customers",$data,"id='".$_REQUEST['txtID']."'")){
					
				echo json_encode(array(
					'success'=>true,
					'msg'=> 'success'
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
	}
	else
	{
			$data = array(
				'title' => $_REQUEST['cbb_E_Title'],
				'name' => $_REQUEST['tx_E_Firstname'],
				'surname' => $_REQUEST['tx_E_Lastname'],
				//'nickname' => $_REQUEST['txtNick'],
				//'dob' => $_REQUEST['txtDOB'],
				'gender' => $_REQUEST['cbb_E_Gender'],
				'email' => $_REQUEST['tx_E_Email'],
				'phone' => $_REQUEST['tx_E_Phone'],
				'mobile' => $_REQUEST['tx_E_Mobile'],
				'#updated' => "NOW()",
			);
			$dbc->Update("contacts", $data,"id='".$_REQUEST['txtconID']."'");
			
			if($pass!='')
			{
				$data = array(
					'#password' => "PASSWORD('".$pass."')",
					'#updated' => 'NOW()',
					//'#user' => $_SESSION['auth']['user_id']
				);
			}
			else
			{
				$data = array(
					'#updated' => 'NOW()',
					//'#user' => $_SESSION['auth']['user_id']
				);
			}
			
			if($dbc->Update("customers",$data,"id='".$_REQUEST['txtID']."'")){
					
				echo json_encode(array(
					'success'=>true,
					'msg'=> 'success'
				));
			}
	}
		
	$dbc->Close();

?>