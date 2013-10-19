<?php
	$request = '';

	if(isset($_GET['request'])){
		$request = $_GET['request'];

		switch ($request) {
			case 'value':
				# code...
				break;
			
			default:
				echo '<h1>Welcome Your Grace';
				break;
		}
	} else {
		//Welcome page
		echo '<h1>Welcome Your Grace</h1>';
	}	
?>