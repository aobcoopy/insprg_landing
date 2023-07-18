<?php
	
// how to change the 'app' ==> so that i will remain changeable

	$appli = array(
		array(
			'name' => 'Dashboard',
			'app' => 'dashboard'
		),
		array(
			'name' => 'User Management',
			'app' => 'user',
			'submenu' => array(
				array(
					'name' => 'Users',
					'app' => 'user'
				),
				array(
					'name' => 'Group',
					'app' => 'group'
				),
			)
		),
		array(
			'name' => 'Article Management',
			'app' => 'Volumes',
			'submenu' => array(
				array(
					'name' => 'Volumes',
					'app' => 'volumes'
				),
				array(
					'name' => 'Articles',
					'app' => 'articles'
				),
			)
		),
		array(
			'name' => 'Customers',
			'app' => 'customers'
		),
	);
	
?>

