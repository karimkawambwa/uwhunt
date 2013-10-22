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
			
		}

		public function getStudentName(){
			return $this->first_name.' '.$this->last_name;
		}

	}
?>