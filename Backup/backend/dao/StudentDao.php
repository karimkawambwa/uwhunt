<?php
/**
 * Created by Karim Kawambwa using PhpStorm.
 * User: kayr1m
 * Date: 11/16/13
 * Time: 5:11 PM
 */

include_once 'lib/Database.php';
include_once 'objects/Student.php';
include_once 'objects/StudentInfo.php';
include_once 'functions/Mail.php';

class StudentDao extends Database {

    function __construct()
    {
        parent::__construct();
    }

    /*
     * PUBLIC FUNCTIONS
     */

    public function isUsernameAvailable($username)
    {
        $student = $this->getStudentByValue('username', $username);
        if ( $student == null)
        {
            /*
             * Username is available
             */
            return null;
        }
        else
        {
            /*
             * Username already taken
             */
            return $student;
        }
    }

    public function isEmailAvailable($email)
    {
    
        $student = $this->getStudentByValue('student_email', $email);
        if ($student == null)
        {
            /*
             * Email is available
             */
            return null;
        }
        else
        {
            /*
             * Email already exists
             */
            return $student;
        }
    }

    public function isStudentVerified($id)
    {
        $student = $this->getStudentInfoByValue('student_id', $id);

        if ($student != null)
        {
            error_log("verifying student ". $student->verified,
                1,"abdul-karym@hotmail.com","From: webmaster@error.com")  ;
            /*
             * Student Info Exists
             */
            if ($student->verified == true)
            {
                // Verified
                error_log("verified",
                    1,"abdul-karym@hotmail.com","From: webmaster@error.com")  ;
                return true;
            }
            else
            {
                // Not verified
                error_log("not verified",
                    1,"abdul-karym@hotmail.com","From: webmaster@error.com")  ;
                return false;
            }
        }
        else
        {
            /*
             * Student Info does not exist
             * Handle this error somehow
             */
            return false;
        }
    }

    public function isStudentBanned($id)
    {
        $student = $this->getStudentInfoByValue('student_id', $id);


        if ($student != null)
        {
            /*
             * Student Info Exists
             */
            if ($student->banned == false)
            {
                // Not banned
                return false;
            }
            else
            {
                // banned
                return true;
            }
        }
        else
        {
            /*
             * Student Info does not exist
             * Handle this error somehow
             */
            return false;
        }
    }

    public function getStudentIdByUsername($user)
    {
        $student = $this->getStudentByValue('username', $user);
        return $student->student_id;
    }

    public function isStudentLoggedIn() {
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            // Check if all session variables are set
            $userLoggedIn = false;
                            
                            
            if(isset($_SESSION['studentId'], $_SESSION['username'], $_SESSION['login_string'])){
                $user_id = $_SESSION['studentId'];
                $login_string = $_SESSION['login_string'];
                $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
                $stmt = $dbConnection->prepare('SELECT student_password FROM Student WHERE student_id = :id');
                

                if($stmt){
                    $stmt->execute(array(':id'=>$user_id)); // Execute the prepared query.
                    $result = $stmt->fetch();

                    if($stmt->rowCount() == 1) { // If the user exists
                        $password = $result['student_password']; // get variables from result.
                        $login_check = hash('sha512', $password.$user_browser);

                        if($login_check == $login_string){
                            // Already Logged In!!!!
                            $userLoggedIn = true;
                        }
                    }
                }
            }

            if($userLoggedIn)
                return true;
            else{
                return false;
                }
                
                

        } catch(PDOException $e) {
            //return 'false';
            error_log( 'Error checking login status: ' . $e->getMessage(),
1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return false;
        }
    }

    public function loginStudent($studentObject){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try {
            /*
             * Check if student entered their email instead.
             * They should be able to login with email or username
             */

            if (isset($studentObject->email) && $this->isValidEmail($studentObject->email))
            {
                $stmt = "SELECT * FROM Student WHERE email LIKE '".$studentObject->email."'";
            }
            else
            {
                $stmt = "SELECT * FROM Student WHERE username LIKE '".$studentObject->username."'";
            }

            $result = $dbConnection->query($stmt);

            // Map results to object
            $result->setFetchMode(PDO::FETCH_CLASS, 'Student');

            if($result->rowCount() > 0){
                $student = $result->fetch();

            } else {
                return 1001;
            }

            if( $this->checkbrute($student->student_id) ) {
                //$login_response['Login'] = 'FAILED';
                //$login_response['Message'] = 'Account is locked';
                //echo json_encode($login_response);
                // Send an email to user saying their account is locked
                return 1006;

            } else {
                /*
                 * Check if the password in the database
                 * matches the password the user submitted.
                 */
                 

                $password = hash("sha256", $studentObject->student_password . $student->salt);
                
                if ( $password == $student->student_password ){
               
                    return $student;
                }
                else
                {
                    /*
                     * Password is not correct
                     * We record this attempt in the database
                     */

                    $now = time();
                    $dbConnection->query("INSERT INTO login_attempts(user_id, time) VALUES('".$student->student_id."', '".$now."')");
                    
                    error_log( 'Entered password: ' . $studentObject->student_password .'\nSaved password: ' . $student->student_password .'\nSalt: ' . $student->salt .'\nHashed password: ' . $password, 1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;

                    return 1001;
                }
            }

        } catch (PDOException $e) {
            error_log( 'Error logging Student: ' . $e->getMessage(),
1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
        }
    }

    /*
	 * Function adds student to the db. Returns id last record.
	 * Will need to add persistence to all these functions;
	 * I.E: what happens if the connection to the db is cut off before call finished etc.
	 * We cannot have half entered data.
	 */
    public function registerStudent($studentObject){
        $this->openConnection();
        $dbConnection = $this->_connection;

        $studentObject->salt = $this->createSalt();

        try {
            $stmt = $dbConnection->prepare("INSERT INTO Student(first_name, last_name, username, student_password,".
                "salt, student_email, student_phone) VALUES(:fname, :lname , :uname, :spass, :salt, :semail, :sphone)");

            $stmt->execute( array(":fname"=>$studentObject->first_name,
                                  ":lname"=> $studentObject->last_name,
                                  ":uname" => $studentObject->username,
                                  ":spass" => hash("sha256", $studentObject->student_password .
                                                             $studentObject->salt), //hash Password Protection
                                  ":salt" => $studentObject->salt,
                                  ":semail" => $studentObject->student_email,
                                  ":sphone" => $studentObject->student_phone
            ));

            //$valid = $stmt->execute($data);
            $lastId = $dbConnection->lastInsertId();

            $this->createStudentInfoForId($lastId);

            $studentObject = $this->getStudentByValue('student_id', $lastId);

            return $studentObject;

        } catch (Exception $e) {
            error_log("Error Registering student: ". $e->getMessage(),
1,"abdul-karym@hotmail.com","From: webmaster@error.com")  ;
            return null;
        }
    }

    public function createStudentInfoForId($id)
    {
        $this->openConnection();
        $dbConnection = $this->_connection;
        try{
            $stmt = $dbConnection->prepare('INSERT INTO Student_Confirmation
                                           (student_id, banned, verified, verification_code)
                                           VALUES(:student_id, :banned , :verified, :verification_code)');

            /*
             * create validation code
             */
            $validation_code = $this->createValidationCode();

            $stmt->execute( array(":student_id"=> $id,
                ":banned"=> false,
                ":verified" => false,
                ":verification_code" => $validation_code
            ));

            /*
             * Email Student temporary link
             * This is for validation
             */


        } catch (Exception $e){
            error_log("Error creating studentInfo: ". $e->getMessage(),
1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;

        }
    }

    /*
     * PRIVATE FUNCTIONS
     */

    private function  isValidEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            /*
             * Email is Valid
             */
            return true;
        }
        else
        {
            /*
             * Email is not Valid
             */
            return false;
        }

    }

    private function createSalt()
    {
        /*
         * Below function uses for loop to select letters nd numbers at random
         * It will produce a 100 character long string
        */

        $randString="";
        $charUniverse="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        for($i=0; $i<100; $i++){
            $randInt=rand(0,61);
            $randChar=$charUniverse[$randInt];
            $randString.=$randChar;
            $i +=1;
        }

        /*
         * Below function uses the system clock to generate a unique number id
         * This number is then appended to the previous generated number to make it more random
         * This will be enough security for the password
        */

        $salt = uniqid($randString, false); //false means no decimal number return from clock

        return $salt;
    }

    private function createValidationCode()
    {
        /*
         * Below function uses for loop to select letters nd numbers at random
         * It will produce a 100 character long string
        */
        
        $uniq_num = uniqid(0,false);
        

        $randString="";
        $charUniverse="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for($i=0; $i < strlen($uniq_num); $i++){
            //$randInt=rand(0,61);
            $randChar=$charUniverse[$uniq_num[$i]];
            $randString.=$randChar;
            //$i +=1;
        }

        /*
         * Below function uses the system clock to generate a unique number id
         * This number is then appended to the previous generated number to make it more random
         * This will be enough security for the password
        */

        $varcode = $randString; //uniqid($randString, false); //false means no decimal number return from clock

        return $varcode;
    }



    private function getStudentInfoByValue($getBy, $value){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try {

            $sql = "SELECT * FROM Student_Confirmation WHERE ".$getBy." = '".$value."'";

            $result = $dbConnection->query($sql);
            $result->setFetchMode(PDO::FETCH_CLASS, 'StudentInfo');

            if($result->rowCount() == 1){
                $student = $result->fetch();
                return $student;
            } else {
                return null;
            }

        } catch (Exception $e) {
            error_log("Error getting Student info from Student_Confirmation: ". $e->getMessage(),
1,"abdul-karym@hotmail.com","From: webmaster@error.com")  ;
            
            return null;
        }

    }

    private function getStudentByValue($getBy, $value){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try {

            $sql = "SELECT * FROM Student WHERE ".$getBy." = '".$value."'";

            $result = $dbConnection->query($sql);

            $result->setFetchMode(PDO::FETCH_CLASS, 'Student');

            if($result->rowCount() == 1){
                $student = $result->fetch();
                return $student;
            } else {
                return null;
            }

        } catch (Exception $e) {
            error_log("Error getting Student: ". $e->getMessage(),
1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return null;
        }

    }

    private function checkbrute($user_id) {
        // Get timestamp of current time
        $now = time();
        // All login attempts are counted from the past 2 hours.
        $valid_attempts = $now - (2 * 60 * 60);
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            // Get timestamp of current time
            if ($security = $dbConnection->prepare('SELECT time FROM login_attempts WHERE user_id = :id AND time > :valid_attempts')) {
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
            error_log( 'Error checking Brute force: ' . $e->getMessage(),
1,"abdul-karym@hotmail.com","From: webmaster@error.com");
            return false;
        }
    }

}

?>