<?php
	session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	include_once "../class/minerva.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	//$os = new minerva($dbc);
	
	$tags = $_REQUEST['tags'];
	
	$data = $dbc->GetRecord("properties","*","name LIKE '%".$tags."%' ");
	echo json_encode($data['ht_link']);
	//echo "search-rent/".destination($des)."/".beach($beach)."/".price($price)."/".bed($room)."/".collection($Collection)."/".bsort($Sort);
	
	
	
?>