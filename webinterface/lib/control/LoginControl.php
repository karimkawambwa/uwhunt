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

		public function checkInStudent(){
			//$request is the $_POST in this case.
			if(isset($this->request['username']) && isset($this->request['enteredPassword'])){
				$postObject = $this->request;

				$student = new Student();

				$student->username = $postObject['username'];
				$student->student_password = $postObject['enteredPassword'];

				$studentDao = new StudentDao();
				$student = $studentDao->loginStudent($student);

				/*Checking if a student was found with the credentials*/
				if($student != null) {
					$_SESSION['studentId'] = $student->student_id;
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