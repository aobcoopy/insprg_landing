<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
	foreach($_REQUEST['tables'] as $table)
	{
		$data = array(
			'#updated' => 'NOW()',
			'#sort' => $table['sort'],
			'#user' => $_SESSION['auth']['user_id']
		);
		
		if($dbc->Update("article_volumes",$data,"id=".$table['id'])){
			
			
		}else{
			/*echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));*/
		}
	}
	
		echo json_encode(array(
				'success'=>true
			));
	
	$dbc->Close();
?>