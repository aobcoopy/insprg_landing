<?php
	session_start();
	unset($_SESSION['view']);
	$_SESSION['view'] = $_REQUEST['view'];