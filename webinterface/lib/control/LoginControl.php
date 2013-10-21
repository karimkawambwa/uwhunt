<?php
	include_once '../domain/Student.php';
	include_once '../dao/StudentDao.php';

	class LoginControl {
		public $request = '';

		public function __construct($_request){
			$this->request = $_request;
		}

		public function getLoginPage(){
			include '../views/loginView.php';
		}
		
		public function checkStudentStatus(){

				$studentDao = new StudentDao();
				
				if ($studentDao->isStudentLoggedIn() == false){ //Student is not logged in
					return json_encode(array('status' => 'nologin',
											 'username' => $_SESSION['username'],
											 'studentId' => $_SESSION['studentId']));
					
				}else{//student is logged in
					return json_encode(array('status' => 'loggedIn',
											 'username' => $_SESSION['username'],
											 'studentId' => $_SESSION['studentId']));
				}

		}

		public function checkInStudent(){
			//$request is the $_POST in this case.
			if(isset($this->request['username']) && isset($this->request['enteredPassword'])){
				$postObject = $this->request;

				$student = new Student();

				$student->username = $postObject['username'];
				$student->student_password = $postObject['enteredPassword'];

				$studentDao = new StudentDao();
				
				if ($studentDao->isStudentLoggedIn() == false){
					$student = $studentDao->loginStudent($student);
					
				}else{//student is already logged in
					return json_encode(array('login' => 'loggedInAlready',
											 'username' => $_SESSION['username'],
											 'studentId' => $_SESSION['studentId']));
				}

				/*Checking if a student was found with the credentials*/
				if($student != null) {
					//$_SESSION['studentId'] = $student->student_id;
					
					// Get the user-agent string of the user.
					$user_browser = $_SERVER['HTTP_USER_AGENT']; 
					
					// XSS protection as we might print these values
					$user_id = preg_replace("/[^0-9]+/", "", $student->student_id); 									$_username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $_username); 
					
					//set the sessions
					$_SESSION['studentId'] = $user_id; 
					$_SESSION['login_string'] = hash('sha512', 
													 $student->student_password.$user_browser);
					$_SESSION['username'] = $_username;
										
					
					return json_encode(array('login' => 'success',
											 'username' => $student->username,
											 'studentId' => $student->student_id));
				} else { //unsuccessful login
					return json_encode(array('login' => 'fail',
											 'username' => null,
											 'studentId' => null));
				}
			}
		}
		
		
	}
?>