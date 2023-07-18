<?php
	/**/session_start();
	include_once "../../config/define.php";
	include_once "../class/db.php";
	include_once "../class/minerva.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new minerva($dbc);
	
	$des = $_REQUEST['cbbDestination'];
	$beach = $_REQUEST['cbbSub'];
	$ar_room = array();
	
	//echo $des.'---'.$beach;
	
	if($des == 'all')
	{
		$destination = "WHERE properties.destination BETWEEN 38 AND 39 ";
	}
	else
	{
		$destination = "WHERE properties.destination = '".$des."'";
	}
	
	if($beach == 'all')
	{
		$beachname = "";
	}
	else
	{
		$beachname = "AND properties.subdestination = '".$beach."'";
	}
	/*echo "SELECT
		properties.id AS id,
		properties.`name` AS `name`,
		properties.destination AS des,
		properties.subdestination AS sub,
		property_room.room AS room
		FROM
		properties
		LEFT JOIN property_room ON properties.id = property_room.property
		".$destination." ".$beachname."
		";*/
		
	$sql =$dbc->Query("SELECT
		properties.id AS id,
		properties.`name` AS `name`,
		properties.destination AS des,
		properties.subdestination AS sub,
		property_room.room AS room
		FROM
		properties
		LEFT JOIN property_room ON properties.id = property_room.property
		".$destination." ".$beachname."
		AND properties.`status` > 0
	");
	//$ar_room[]='';
	while($row = $dbc->Fetch($sql))
	{
		//echo $row['room']."<br>";
		if(!in_array($row['room'],$ar_room))
		{
			array_push($ar_room,$row['room']);
			/*$ar_room[] = array(
				"room" =>$row['room']
			);*/
		}
	}
	sort($ar_room);
	echo json_encode($ar_room);
?>