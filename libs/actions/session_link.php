<?php
	session_start();
	unset($_SESSION['desti']);
	$_SESSION['desti'] = $_REQUEST['des'];
	echo json_encode(true);
?>