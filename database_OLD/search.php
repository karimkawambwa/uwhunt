<?php
	require('lib/session.class.php');
	require('lib/house.data.accesor.class.php');

	$session = new session();
	$search = new Search();
	
	// Set to true if using https
	$session->start_session('_s', false);

	
	$command = $_GET['command'];
	
	switch ($command){
		case 'address'://search by address
			break;
		
		case 'city'://search by city
			$city = $_GET['search'];
			$search->gethousebycity($city);
				break;
		
		case 'work'://search by work
				break;
		
	}


	
?>