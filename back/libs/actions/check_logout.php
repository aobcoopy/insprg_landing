<?php
	session_start();
	unset($_SESSION['auth']);
	echo json_encode(true);
?>