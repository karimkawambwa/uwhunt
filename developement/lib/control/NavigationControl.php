<?php
	class NavigationControl {
		public $session;

		public function __constructor(){
			$this->session = $_SESSION;
		}

		public function getFrontPage(){
			include '../views/frontPageView.php';
		}

	}
?>