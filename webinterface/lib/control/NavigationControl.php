<?php
	class NavigationControl {
		public $session;

		public function __constructor(){
			$this->session = $_SESSION;
		}

		public function getFrontPage(){
			include_once '../views/frontPageView.php';
		}

		public function getStudentProfile($studentObject){
			$data = $studentObject;
			include_once '../views/studentProfileView.php';
		}
	}
?>