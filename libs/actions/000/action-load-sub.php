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
	
	$id = $_REQUEST['iddes'];
	if($id=='all')
	{
		$sql = $dbc->Query("select * from  destinations where parent is not null and status > 0 order by name asc");		
	}
	else
	{
		$sql = $dbc->Query("select * from  destinations where parent = '".$id."' and status > 0 order by name asc");	
	}
	
	while($row = $dbc->Fetch($sql))
	{
		if(isset($_REQUEST['sub']))
		{
			$sub = ($_REQUEST['sub']==$row['id'])?'selected':'';
		}
		else
		{
			$sub = '';
		}
		echo '<option value="'.$row['id'].'" '.$sub.'>'.$row['name'].'</option>';	
	}

	
	
	
?>
