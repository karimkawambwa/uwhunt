<?php
	class LoginControl {
		public $request = '';

		public function __construct($_request){
			$this->request = $_request;
		}

		public function getLoginPage(){
			include '../views/loginView.php';
		}

	}
?>