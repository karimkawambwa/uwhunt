<?php
	class Student{
		public $idstudent;
		public $first_name;
		public $last_name;
		public $username;
		public $student_password;
		public $salt;
		public $student_email;
		public $student_phone;
	}

	public function __construct(){}

	public function getStudentName(){
		return $first_name.' '.$last_name;
	}

?>