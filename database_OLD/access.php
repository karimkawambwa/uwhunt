<?php
	require('lib/user.class.php');
	require('lib/authentication.class.php');
	require('lib/session.class.php');

	$user = new User();
	$auth = new Authentication();
		
	$command = $_POST['command'];
	$_command = $_GET['command'];
	
	if ($command != ''){
		switch ($command){
				case 'register':
					$_firstname = $_POST['firstname']; 
					$_lastname = $_POST['lastname']; 
					$_username = $_POST['username']; 
					$_email = $_POST['email']; 
					$_password = $_POST['password']; 
					$_salt = 'salt';//$_POST['salt']; 
					$_phone_number= $_POST['phone_number']; 
					$_allow_calling= $_POST['allow_calling'];
					$_joined = date("D/M/Y");
					
			
					if ($user->isEmailAvailable($_email) == true)
					{
						if ($user->isUsernameAvailable($_username) == true)
						{
							//set the random id length 
							$random_id_length = 40; 
							//generate a random id encrypt it and store it in $rnd_id 
							$rnd_id = crypt(uniqid(rand(),1)); 
							//to remove any slashes that might have come 
							$rnd_id = strip_tags(stripslashes($rnd_id)); 
							//Removing any . or / and reversing the string 
							$rnd_id = str_replace(".","",$rnd_id); 
							$rnd_id = strrev(str_replace("/","",$rnd_id)); 
							//finally I take the first 10 characters from the $rnd_id 
							$rnd_id = substr($rnd_id,0,$random_id_length); 
							
							$validation = $rnd_id;
							
							$user->register($_firstname, $_lastname, $_username, $_password, 
								$_salt, $_email, $_phone_number, $_allow_calling, $validation);
					
							 break;
						}else { echo "username exists"; break;} }else{echo "email exists"; break;}
				
				case 'logout':
						$session = new session();
	
						// Set to true if using https
						$session->start_session('_s', false);

						// Unset all session values
						$_SESSION = array();
						
						// get session parameters 
						$params = session_get_cookie_params();
						
						// Delete the actual cookie.
						setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
						
						// Destroy session
						session_destroy();
		
						$login_response['Login'] = 'LOGGED OUT';
						$login_response['Message'] = 'Successfully logged out.';
					    $login_response['extraMap'] = NULL;
					               
						$response['Response'] = $login_response;
					               
						echo json_encode($response);	
						break;
				
				case 'login':
						$session = new session();
	
						// Set to true if using https
						$session->start_session('_s', false);
						
						$username = $_POST['username'];
						$password = $_POST['password'];
						
						//check if previously logged in
						if ($auth->isLoggedIn() == true){
							//echo "logged in already";
							 break;
						
						//login if not previously logged in
						}else if ($auth->login($username, $password) == true){
						
						//on successful login
						//echo "logged in"; 
						break; }
						
						//on failed login
						else { //echo "failed"; 
						break;}
		
				
				case 'status':
						$session = new session();
	
						// Set to true if using https
						$session->start_session('_s', false);
						
						//check if previously logged in
						if ($auth->isLoggedIn() == true){
							
							//echo "Logged in already"; 
							
							   $userJson['UserId'] = $_SESSION['user_id'];
				               $userJson['Username'] = $_SESSION['username'];
				               $userJson['Email'] = $_SESSION['email'];
				               $userJson['Firstname'] = $_SESSION['firstname'];
				               $userJson['Lastname'] = $_SESSION['lastname'];
				               
							   $login_response['Login'] = 'LOGGED IN';
							   $login_response['Message'] = 'User is already logged in.';
							   $login_response['extraMap'] = $userJson;
				               
							   $response['Response'] = $login_response;
				               
							   echo json_encode($response);
							   
							break;
						
						}else{
							//echo "Not logged in"; 
							 $login_response['Login'] = 'NOT LOGGED IN';
							 $login_response['Message'] = 'Not logged in.';
							 $login_response['extraMap'] = NULL;
					               
							 $response['Response'] = $login_response;
					               
							 echo json_encode($response);
							break;
						}
						
				default:
						echo 'break';
						break;
			
		}
	}

	else if ($_command != ''){
			switch ($_command){
				case 'validate':
						$session = new session();
	
						// Set to true if using https
						$session->start_session('_s', false);
						
						$user->validate($_GET['code']);
						break;
						
				case 'test':
						echo 'test';
						break;
				
				default:
						echo 'break';
						break;
			}
	}
	
	else{
		$error['ERROR'] ='unrecognized command';
		$response['Response'] = $error;
		echo json_encode($response);
	}
	
	

	
?>