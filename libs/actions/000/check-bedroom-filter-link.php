<?php

    session_start();
    include_once "../../config/define.php";
    include_once "../../libs/class/db.php"; 
    
    $dbc = new dbc;
    $dbc->Connect();    
	
	$des = $_REQUEST['cbbDestination']; 
	$beach = $_REQUEST['cbbSub'];
	$price = 'all';//$_REQUEST['cbbPrice'];
	$room = $_REQUEST['bedroomRangeFilter'];
	if(isset($_REQUEST['cbbCollection']))
	{
		$Collection = $_REQUEST['cbbCollection'];
	}
	else
	{
		$Collection = "0";
	}
    
	if(isset($_REQUEST['cbbSort']))
	{
		$Sort = $_REQUEST['cbbSort'];
	}
	else
	{
		$Sort = "all";
	} 
     
    include_once "../../inc/functions.inc.php";
    if(countryIdSlugNameFromDestinationID($des)[0] == "") $countryID = 0; 
    else $countryID = countryIdSlugNameFromDestinationID($des)[0];
    
    echo URL_builder($countryID, $des, $beach, $room, $Collection, $price, $Sort, $arrayUrlVariables);
	
?>