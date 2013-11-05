<?php
	class Student{
		public $student_id;
		public $first_name;
		public $last_name;
		public $username;
		public $student_password;
		public $salt;
		public $student_email;
		public $student_phone;
	
		public function __construct(){
			/*$this->student_id = '';
			$this->first_name = '';
			$this->last_name = '';
			$this->username = '';
			$this->student_password = '';
			$this->salt = '';
			$this->student_email = '';
			$this->student_phone = '';*/

		}

		public function getStudentName(){
			return $this->first_name.' '.$this->last_name;
		}

	}
?>