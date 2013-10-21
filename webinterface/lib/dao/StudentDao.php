<?php
	include_once 'Database.php';

	class StudentDao extends Database{
		
		public function __construct(){
			parent::__construct();
		}

		public function getStudent($studentObject){

		}
		
		private function checkbrute($user_id) {
			   	// Get timestamp of current time
			   	$now = time();
			   	// All login attempts are counted from the past 2 hours. 
			   	$valid_attempts = $now - (2 * 60 * 60); 
			   	$this->openConnection();
				$dbConnection = $this->_connection;
				//$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
				try{
					// Get timestamp of current time
				   	if ($security = $dbConnection->prepare('SELECT time FROM login_attempts WHERE user_id = :id AND time > :valid_attempts')) { 
				      
				      // Execute the prepared query.
				      $security -> execute(array(':id' => $user_id,
				      						     ':valid_attempts' => $valid_attempts)); // Execute the prepared query.
				      $_result = $security->fetchAll();
				      // If there has been more than 5 failed logins
				      
				      if($security->rowCount() > 5) {
				         return true;
				      } else {
				         return false;
				      }
				   }

				   } catch(PDOException $e) {
							//return 'false';
							echo 'Error checking Brute force: ' . $e->getMessage();
						}
			   }
		
		
		public function isStudentLoggedIn() {
					$this->openConnection();
					$dbConnection = $this->_connection;
					
			try{
				//$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			   				// Check if all session variables are set
				if(isset($_SESSION['studentId'], $_SESSION['username'], $_SESSION['login_string'])) 						{
					   
					     $user_id = $_SESSION['studentId'];
					     $login_string = $_SESSION['login_string'];
					    // $username = $_SESSION['username'];
					 
					     $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
					     if ($stmt = $dbConnection->prepare('SELECT student_password FROM Student WHERE student_id = :id')) { 
					        
					        $stmt->execute(array(':id'=>$user_id)); // Execute the prepared query.
					        $result = $stmt->fetch();

					        if($stmt->rowCount() == 1) { // If the user exists
					           $password = $result['student_password']; // get variables from result.
					           $login_check = hash('sha512', $password.$user_browser);
					
					           if($login_check == $login_string) {
					              // Already Logged In!!!!
					              
					              return true;
									           } else {
									              // Not logged in
									              return false;
									           } } else {
									            // Not logged in
									            return false;
									        } } else {
									        // Not logged in
									        return false;
									     } } else {
									     // Not logged in
									     return false;
						   }
						   } catch(PDOException $e) {
								//return 'false';
								echo 'Error checking login status: ' . $e->getMessage();
								}
		}


		public function loginStudent($studentObject){
			$this->openConnection();
			$dbConnection = $this->_connection;

			try {
				$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//need to write code to check if they entered their email instead. They should be
				//able to login with email or username

				$stmt = "SELECT * FROM Student WHERE username LIKE '".$studentObject->username."'";
				$result = $dbConnection->query($stmt);

				//Map results to object
				$result->setFetchMode(PDO::FETCH_CLASS, 'Student');

				if($result->rowCount() == 1){
					$student = $result->fetch();
					
				} else {
				
					return null;
				}
				
				if( $this->checkbrute($student->student_id) ) { 
			         
			         			//$login_response['Login'] = 'FAILED';
			         			//$login_response['Message'] = 'Account is locked';
					 
					            //echo json_encode($login_response);
					            
			            // Send an email to user saying their account is locked
			            
			            return null;

			         } else {
			         // Check if the password in the database matches the password the user submitted. 
			         //later when hashing is introduced i will add some more functionality here
			         //i will change some stuff

			         	return $student;
			         }

		
			} catch (PDOException $e) {
				echo 'Error logging Student: ' . $e->getMessage();
				return null;
			}
		}
	}
?>