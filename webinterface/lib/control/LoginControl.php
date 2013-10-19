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
				$studentDao->loginStudent($student);

			}
		}
	}
?>