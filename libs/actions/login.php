<?php 
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();

	$pass = $_REQUEST['tx_password'];
	/*$data = $dbc->GetRecord("customers AS c,contacts AS co","c.id,c.email,co.name,co.surname","c.contact = co.id and c.email = '".$_REQUEST['tx_email']."' and c.password=PASSWORD('$pass')");
	print_r($data);*/
	if($dbc->HasRecord("customers","email = '".$_REQUEST['tx_email']."' and password=PASSWORD('$pass')"))
	{
		$data = $dbc->GetRecord("customers AS c,contacts AS co","c.id,c.email,co.name,co.surname","c.contact = co.id and c.email = '".$_REQUEST['tx_email']."' and c.password=PASSWORD('$pass')");
		//$line=$dbc->GetRecord("users,groups","users.id, users.name, users.gid, groups.name","groups.id=users.gid AND users.name='$username'");
		$_SESSION['user']['id'] = $data[0];
		$_SESSION['user']['email'] = $data[1];
		$_SESSION['user']['name'] = $data[2].'&nbsp;&nbsp;&nbsp;'.$data[3];
		/*print_r($data);
		echo '>>'.$_SESSION['user']['email'];*/
		
		$data_s = array(
			'#last_login' => 'NOW()','#updated' => 'NOW()'
		);
		$dbc->Update("customers",$data_s,"id='".$data[0]."'");
		
		
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
