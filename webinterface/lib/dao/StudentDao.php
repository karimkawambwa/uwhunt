<?php
	include_once 'Database.php';

	class StudentDao extends Database{
		
		public function __construct(){
			parent::__construct();
		}

		public function getStudent($studentObject){

		}

		public function loginStudent($studentObject){
			$this->openConnection();
			$dbConnection = $this->_connection;

			try {
				$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//need to write code to check if they entered their email instead. They should be
				//able to login with email or username

				$stmt = "SELECT * FROM student WHERE username LIKE '".$studentObject->username."'";
				$result = $dbConnection->query($stmt);

				//Map results to object
				$result->setFetchMode(PDO::FETCH_CLASS, 'Student');

				if($result->rowCount() == 1){
					$student = $result->fetch();
					return $student;
				} else {
					return null;
				}
		
			} catch (PDOException $e) {
				echo 'Error logging Student: ' . $e->getMessage();
				return null;
			}
		}
	}
?>