<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../libs/class/db.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	
	
		$pho = $dbc->GetRecord("article_volumes","*","id='".$_REQUEST['txtID']."'");
		if($_REQUEST['tx_E_photo']!='')
		{
			unlink('../../../../'.json_decode($pho['photo'],true));
			$data = array(
				'name' => $_REQUEST['tx_E_Name'],
				'photo' => json_encode($_REQUEST['tx_E_photo']),
				'#updated' => 'NOW()',
				'#status' => '0',
				'#user' => $_SESSION['auth']['user_id']
			);
		
		}
		else
		{
			$data = array(
				'name' => $_REQUEST['tx_E_Name'],
				//'photo' => json_encode($_REQUEST['tx_E_photo']),
				'#updated' => 'NOW()',
				'#status' => '0',
				'#user' => $_SESSION['auth']['user_id']
			);
		}
		
		
		
		if($dbc->Update("article_volumes",$data,"id='".$_REQUEST['txtID']."'")){
			
			if($_REQUEST['txt_E_pdf']!='')
			{
				unlink('../../../../'.json_decode($pho['files'],true));
				$data['files'] = json_encode($_REQUEST['txt_E_pdf']);
				$dbc->Update("article_volumes",$data,"id='".$_REQUEST['txtID']."'");
			}
			
			echo json_encode(array(
				'success'=>true,
				'msg'=> 'Success'
			));
		}
		else
		{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Please try again"
			));
		}
	
	$dbc->Close();

?>