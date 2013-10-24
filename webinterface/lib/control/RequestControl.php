<?php
	include_once('LoginControl.php');
	include_once('StudentControl.php');
	include_once('NavigationControl.php');
	include_once('../domain/Student.php');
	require('../dao/session.class.php');

	$request = '';
	$navigationControl = new NavigationControl();
	if(isset($_GET['request'])){
		$request = $_GET['request'];

		switch ($request){
			case 'studentSignUp':
				$student = new Student();
				$studentControl = new StudentControl($student);
				$studentControl->studentSignUp($_POST);
				break;

			case 'loginStudent':
				//start session here because you don't want
				//to create alot of useless sessions
				//this creates a logged in session
				
				$session = new session();
				// Set to true if using https
				$session->start_session('_s', false);
				
				studentLogin();
				break;
				
			case 'logout':
				//start session here because you don't want
				//to create alot of useless sessions
				//this also gives handle to the current logged in session
				
				$session = new session();
				// Set to true if using https
				$session->start_session('_s', false);
		
				studentLogout();
				break;
			
			case 'status':
				//start session here because you don't want
				//to create alot of useless sessions
				//this also gives handle to the current logged in session
				
				$session = new session();
				// Set to true if using https
				$session->start_session('_s', false);
				
				checkLoginStatus();
				break;
				
			case 'studentProfile':
				$studentId = $_GET['studentId'];
				$student = new Student();
				$studentControl = new StudentControl($student);
				$returnedStudent = $studentControl->getStudentById($studentId);
				$navigationControl->getStudentProfile($returnedStudent);
				break;
			default:
				//Home page
				$navigationControl->getFrontPage();
				break;
		}
	} else {
		//Welcome page
		$navigationControl->getFrontPage();
	}
	
	function checkLoginStatus(){
		$loginControl = new LoginControl(null);
		echo($loginControl->checkStudentStatus());
	}


	function studentLogin(){
		$postRequest = $_POST;
		$loginControl = new LoginControl($postRequest);
		echo($loginControl->checkInStudent());
	}
	
	function studentLogout(){
		// Unset all session values
		$_SESSION = array();
		
		// get session parameters 
		$params = session_get_cookie_params();
		
		// Delete the actual cookie.
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"],
		$params["secure"], $params["httponly"]);
		
		// Destroy session
		session_destroy();
	               
		echo json_encode(array('logout' => 'success'));
	}
?>