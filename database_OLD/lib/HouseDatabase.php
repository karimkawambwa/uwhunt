<?php
	class HouseDatabase {
		protected $_host;
		protected $_database;
		protected $_user;
		protected $_password;
		protected $_connection;
		
		public function __construct(
	        $host = 'mysql6.000webhost.com',
	        $database = 'a2058586_House',
	        $user = 'a2058586_house',
	        $password = 'chataloo2013'
	    )
	    {
	        $this->_host   = $host;
	        $this->_database = $database;
	        $this->_user     = $user;
	        $this->_password = $password;
	    }

		public function openConnection(){
			try{
				$this->_connection = new PDO('mysql:host='.$this->_host.';dbname='.$this->_database, 
											$this->_user, $this->_password);
				$this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo 'ERROR: '. $e->getMessage();
			}
		}
		
		public function endConnection(){
			$this->_connection = null;
		}
	}
?>