<?php
	include_once 'Database.php';
	
	class User extends Database{
		
		public function __construct(){
			parent::__construct();
			}

				public function isEmailAvailable($emailToCheck){
					
					//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare('SELECT * FROM User WHERE email LIKE ?');
						$q = $emailToCheck;
						$stmt -> execute(array($q));

						$result = $stmt->fetchAll();
						if($stmt->rowCount() > 0){
							return false;
						} else {
							return true;
						}
											
					} catch(PDOException $e){
						echo 'ERROR checking Email Availability: ' . $e->getMessage();
						}
				}

				public function isUsernameAvailable($usernameToCheck){
					
					//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare('SELECT * FROM User WHERE username LIKE ?');
						$q = $usernameToCheck;
						$stmt -> execute(array($q));

						$result = $stmt->fetchAll();
						if($stmt->rowCount() > 0){
							return false;
						} else {
							return true;
						}

					}catch(PDOException $e){
						echo 'ERROR: ' . $e->getMessage();
						}
				}

				public function register($firstname, $lastname, $username, $password, $salt, $email, $phone_number, $allow_calling, $code){
					
					//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare ("INSERT INTO User 
						(Firstname, Lastname, Username, Password, Salt, Email, Phone, AllowCall, Varified, Banned, ValidationCode) 
						VALUES (:fname, :lname, :uname, :pass, :salt, :email, :phone, :allow, :var, :ban, :code)");
						
						$_stmt = $dbConnection->prepare('SELECT * FROM User WHERE Username LIKE ?');
					
						$stmt->execute(array(	':fname'	=>		$firstname,
												':lname'	=>		$lastname,
												':uname'	=>		$username,
												':pass'		=>		$password,
												':salt'		=>		$salt,
												':email'	=>		$email,
												':phone'	=>		$phone_number,
												':allow'	=>		true,
												':var'		=> 		false,
												':ban'		=> 		false,
												':code'		=>		$code 			));
						
						$_stmt->execute(array( $username ));
						$result = $_stmt->fetchAll();
						if ($_stmt->rowCount())
						{
							$this->mailValidation($email, $code, $firstname." ".$lastname);
							echo "success";
						}
						else
						{
							echo "failed";
						}
					}catch(PDOException $e){
						echo 'ERROR: ' . $e->getMessage();
						}
				}
				
				public function mailValidation($to, $code, $name)
				{
					$link = 'http://www.chataloo.comli.com/access.php?command=validate&code=' . $code;
					$subject = 'Validation';
					$message = 'Hello ' . $name .',
					Welcome to the Co-op house hunt, in order to use the services kindly validate your email by clicking the link below.
					'
					
					. $link .
					
					'Do not reply to this email address, it is an automatic message. To contact us send us mail to chataloo@gmail.com.
					
					Regards
					Chataloo Team';
					
					$headers = 'From: webmaster@example.com' . "\r\n" .
					    'Reply-To: webmaster@example.com' . "\r\n" .
					    'X-Mailer: PHP/' . phpversion();
					
					mail($to, $subject, $message, $headers);
				}
				
				public function validate($code)
				{
					//open connection
					$this->openConnection();
					$dbConnection = $this->_connection;
					
					try{
						$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt = $dbConnection->prepare('SELECT * FROM User WHERE ValidationCode LIKE ?');
						$_stmt = $dbConnection->prepare('UPDATE User SET Varified = :var WHERE ValidationCode = :code');
						
						$stmt->execute(array( $code ));
						$result = $_stmt->fetch();
						
						if ($stmt->rowCount() > 0)
						{
							$stmt->execute(array( 	  ':var'	=> 		true,
													  ':code'	=>		$code	 ));
													  
							echo 'validated';
						}
						else
						{
							echo 'failed validation';
						}
						
					}catch(PDOException $e){
						echo 'ERROR: ' . $e->getMessage();
						}
				}
		}
?>