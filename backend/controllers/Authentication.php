<?php
/**
 * Created by Karim Kawambwa using PhpStorm.
 * User: kayr1m
 * Date: 11/16/13
 * Time: 4:12 PM
 */

include_once('dao/StudentDao.php');
include_once('objects/Student.php');

/*
 * LOGIN CONTROLLER
 */
class LoginController
{
    public $student;
    function __construct($obj)
    {
        $this->student = $obj;
    }
    
    public function beginLogoutFlow(){

        $studentDao = new StudentDao();

        if ($this->checkLoginStatus() != 3004){
       	    /*
             * There is a logged in student 
             * Log them out
             */
             
            // Unset all session values
			$_SESSION = array();
			
			// get session parameters 
			$params = session_get_cookie_params();
			
			// Delete the actual cookie.
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"],
			$params["secure"], $params["httponly"]);
			
			// Destroy session
			session_destroy();

            return 4001;

        }else{
            
            /*
             * No student is logged in
             */
            return 4002;
        }

    }

    public function checkLoginStatus(){

        $studentDao = new StudentDao();

        if ($studentDao->isStudentLoggedIn() == false){
            /*
             * Student is not logged in
             */
            return 3004;

        }else{
            /*
             * Student is already logged in
             */
            return 1002;
        }

    }

    public function beginLoginFlow(){
        /*
         * $student is the $_POST in this case.
         */
        if(isset($this->student->username) && isset($this->student->student_password)
        || isset($this->student->email) && isset($this->student->student_password)){
            
            $studentDao = new StudentDao();
            
            if ($studentDao->isStudentLoggedIn() == false){

	            $id = $studentDao->getStudentIdByUsername($this->student->username);
	           
	           if ($id == null){
                    return 1001;
                }
                
	            /*
	             * Check if this User is not banned
	             */
	            if ($studentDao->isStudentBanned($id))
	            {
	                // This email has been flagged
	                return 1003;
	            }
	
	            /*
	             * Check if this User is verified
	             */
	            if (!$studentDao->isStudentVerified($id))
	            {
	                // This email has been flagged
	                return 1004;
	            }

            
                $return = $studentDao->loginStudent($this->student);
                
            }else{//student is already logged in
                return 1002;
            }

            /*
             * Checking if a student was found with the credentials
             */
            if($return!= 1006 && $return != 1001 && $return != 1002) {

                // Get the user-agent string of the user.
                $user_browser = $_SERVER['HTTP_USER_AGENT'];

                // XSS protection as we might print these values
                $user_id = preg_replace("/[^0-9]+/", "", $return->student_id);
                $_username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $return->username);

                //set the sessions
                $_SESSION['studentId'] = $user_id;
                $_SESSION['login_string'] = hash('sha512', $return->student_password.$user_browser);
                $_SESSION['username'] = $_username;

				$this->student = $return;

                return $this->student;

            } else { //unsuccessful login

                return $return;
            }
        }
    }


}

/*
 * REGISTRATION CONTROLLER
 */
class RegistrationController
{
    public $student;
    function __construct($obj)
    {
        $this->student = $obj;
    }
    /*
     * PUBLIC FUNCTIONS
     */

    public function beginRegistrationFlow(){
        /*
         * We assume validation is complete at this point.
         * That is, we have check if the email is free, passwords match etc.
         * All we are doing here is setting up the student object and firing off the StudentDao
         */


        //consider add the date the student was added.
//        $this->sentRequest = $_request;
//        $this->student->student_email = $this->sentRequest['studentEmail'];
//        $this->student->student_password = $this->sentRequest['enteredPassword'];

        $studentDao = new StudentDao();


        /*
         * Check if email is available
         */
        $return = $studentDao->isEmailAvailable($this->student->student_email);
        //var_dump($return);
        if ($return != null){

            /*
             * Email has been used
             * Tell student to login
             * Or ask if student forgot password
             */

            /*
             * Check if this User is not banned
            */
            if ($studentDao->isStudentBanned($return->student_id))
            {
                // This email has been flagged
                return 2003;

            }

            return 2002;
        }
        

        /*
         * Check if username is available
         */
        $return = $studentDao->isUsernameAvailable($this->student->username);
        //var_dump($return);
        if ($return != null){
            /*
             * Username has been taken
             * Ask them to choose another
             * Implement function to suggest username
             */

            /*
             * Check if this User is not banned
            */
            if ($studentDao->isStudentBanned($return->student_id))
            {
                // This email has been flagged
                return 2003;

            }

            return 2001;
        }
      //  $id = $studentDao->getStudentIdByUsername($this->student->username);

        $returnedStudent = $studentDao->registerStudent($this->student);

        if($returnedStudent != null) {
            // send validation email
            return 2004;

        } else {
            //return to frontpage with error message
            return 2005;
        }


    }

//    public function getStudentById($id){
//        $studentDao = new StudentDao();
//        $returnedStudent = $studentDao->getStudentByValue("id", $id);
//        return $returnedStudent;
//    }

}

/*
 * VALIDATION CONTROLLER
 */
class ValidationController
{
    public $code;
    function __construct($_code)
    {
        $this->code = $_code;
    }

}


?>