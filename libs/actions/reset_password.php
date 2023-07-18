<?php 
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();

	$id = $_REQUEST['txtID'];
	$email = $_REQUEST['txtemail'];
	$pass = $_REQUEST['tx_Old_password'];
	$New_pass = $_REQUEST['tx_New_password'];
	/*$data = $dbc->GetRecord("customers AS c,contacts AS co","c.id,c.email,co.name,co.surname","c.contact = co.id and c.email = '".$_REQUEST['tx_email']."' and c.password=PASSWORD('$pass')");
	print_r($data);*/
	if($dbc->HasRecord("customers","email = '".$email."' and password=PASSWORD('$pass') and id = '".$id."' "))
	{
		$ar_data = array(
			'#password' => "PASSWORD('$New_pass')",
			'#updated' => 'NOW()'
		);
		if($dbc->Update("customers",$ar_data,"id='".$id."'"))
		{
			unset($_SESSION['user']);
			$data = $dbc->GetRecord("customers AS c,contacts AS co","c.id,c.email,co.name,co.surname","c.contact = co.id and c.email = '".$email."' and c.password=PASSWORD('$New_pass')");
			$_SESSION['user']['id'] = $data[0];
			$_SESSION['user']['email'] = $data[1];
			$_SESSION['user']['name'] = $data[2].'&nbsp;&nbsp;&nbsp;'.$data[3];
			
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
					'msg' => 'Please try again.'
				)
			);
		}
	}
	else
	{
		echo json_encode(
			array(
				'status' => false,
				'msg' => 'Information is mismatch. Please check your password.'
			)
		);
	}
?>
