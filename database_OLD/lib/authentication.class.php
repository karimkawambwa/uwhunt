<?php
	include_once 'Database.php';
	
	class Authentication extends Database{
		public function __construct(){
			parent::__construct();
			}
			
				function checkbrute($user_id) {
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
			
				function login($_username, $password) {
			    //Using prepared Statements means that SQL injection is not possible. 
			   	$this->openConnection();
				$dbConnection = $this->_connection;
				//$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				try{
			   		if ($stmt = $dbConnection->prepare('SELECT * FROM User WHERE Username = :un')) { 
			      		
			      		$stmt -> execute(array(':un' => $_username)); // Execute the prepared query.
			      		
			      		$result = $stmt->fetch();
			      		
			      		if ($stmt->rowCount() > 0)
			      		{
			      		$user_id = $result['userId'];
			      		$_email = $result['Email'];
			      		$_password = $result['Password'];
			      		$phone_number = $result['Phone'];
			      		$firstname = $result['Firstname'];
			      		$lastname = $result['Lastname'];
			      		//$salt = $result['salt']; // get variables from result.
			      		//$pw = hash('sha512', $password.$salt); // hash the password with the unique salt.
			      		
			      		}else{
			      				$login_response['Login'] = 'FAILED';
			         			$login_response['Message'] = 'User Does not Exist';
					 			$login_response['extraMap'] = NULL;
					               
					            $response['Response'] = $login_response;
					               
					            echo json_encode($response);
								return false;
			      		}
			 
			      		//if($stmt->rowCount() == 1) { // If the user exists
			         	// We check if the account is locked from too many login attempts
			         	
			         if( $this->checkbrute($user_id) ) { 
			         
			         			$login_response['Login'] = 'FAILED';
			         			$login_response['Message'] = 'Account is locked';
					 			$login_response['extraMap'] = NULL;
					               
					            $response['Response'] = $login_response;
					               
					            echo json_encode($response);
			            // Send an email to user saying their account is locked

			         } else {
				
					         if($_password == $password) { // Check if the password in the database matches the password the user submitted. 
					            //Password is correct!
					 			
					               $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
					               $user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
					               $_SESSION['user_id'] = $user_id; 
					               $_username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $_username); // XSS protection as we might print this value
					               $_SESSION['username'] = $_username;
								   $_email= preg_replace("/[^a-zA-Z0-9_\-]+/", "", $_email); // XSS protection as we might print this value
								   $_SESSION['email'] = $_email; 
					               $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
					               $_email= preg_replace("/[^a-zA-Z0-9_\-]+/", "", $firstname); // XSS protection as we might print this value
								   $_SESSION['firstname'] = $firstname; 
								   $_email= preg_replace("/[^a-zA-Z0-9_\-]+/", "", $lastname); // XSS protection as we might print this value
								   $_SESSION['lastname'] = $lastname; 
					               
					               
					               // Login successful.
					               
								   $userJson['UserId'] = $user_id;
					               $userJson['Username'] = $_username;
					               $userJson['Email'] = $_email;
					               $userJson['Firstname'] = $firstname;
					               $userJson['Lastname'] = $lastname;
					               
					               $login_response['Login'] = 'SUCCESS';
					               $login_response['extraMap'] = $userJson;
					               
					               $response['Response'] = $login_response;
					               
					               echo json_encode($response);
					               
					               return true;    

					         } else {

					            // Password is not correct
					            // We record this attempt in the database
					            $now = time();
					            $dbConnection->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
					            
					            $login_response['Login'] = 'FAILED';
					            $login_response['Message'] = 'Incorrect Username or Password.';
					            $login_response['extraMap'] = NULL;
					               
					            $response['Response'] = $login_response;
					               
					            echo json_encode($response);

					            return false;

					         }
					      }
					      //} else {
					         // No user exists. 
					         //return false;
					     // }
					   }
					   } catch(PDOException $e) {
								//return 'false';
								echo 'Error Logging in: ' . $e->getMessage();
							}
					}

					function isLoggedIn() {
					$this->openConnection();
					$dbConnection = $this->_connection;
					//$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					try{
				   		// Check if all session variables are set
					   if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
					   
					     $user_id = $_SESSION['user_id'];
					     $login_string = $_SESSION['login_string'];
					     $socioname = $_SESSION['username'];
					 
					     $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.

					     if ($stmt = $dbConnection->prepare('SELECT password FROM User WHERE userID = :id')) { 
					        
					        $stmt->execute(array(':id'=>$user_id)); // Execute the prepared query.
					        $result = $stmt->fetch();

					        if($stmt->rowCount() == 1) { // If the user exists
					           $password = $result['password']; // get variables from result.
					           $login_check = hash('sha512', $password.$user_browser);
					
					           if($login_check == $login_string) {
					              // Logged In!!!!
					              //echo "<br/> Logged In!!!! <br/>";
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
			
				public function logout($username, $password){
				}
			}
?>