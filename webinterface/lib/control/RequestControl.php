<?php
	include_once('LoginControl.php');

	$request = '';

	if(isset($_GET['request'])){
		$request = $_GET['request'];

		switch ($request){
			case 'navigateToLogin':
				$loginControl = new LoginControl($request);
				$loginControl->getLoginPage();
				break;
			case 'loginStudent':
				studentLogin();
				break;
			default:
				//Welcome page
				echo '<h1>Welcome Your Grace';
				break;
		}
	} else {
		//Welcome page
		echo '<h1>Welcome Your Grace</h1>';
	}

	function studentLogin(){
		$postRequest = $_POST;
		$loginControl = new LoginControl($postRequest);
		$loginControl->checkInStudent();
	}
?>