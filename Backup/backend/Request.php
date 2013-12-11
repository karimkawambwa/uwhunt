<?php
/**
 * Created by Karim Kawambwa using PhpStorm.
 * User: kayr1m
 * Date: 11/16/13
 * Time: 4:11 PM
 */

include_once 'lib/Session.php';

include_once 'controllers/Authentication.php';
include_once 'controllers/Post.php';
include_once 'controllers/DataAccessor.php';

include_once 'objects/Student.php';
include_once 'objects/HouseOwner.php';
include_once 'objects/House.php';
include_once 'objects/HouseImage.php';
include_once 'objects/Company.php';

include_once 'functions/Respond.php';

$request = '';
$respond = new Respond();
$_student = new Student();

/*
 * Switch case to handle the different types
 * of requests from get function
 */



if (isset($_GET['request']))
{
    $request = $_GET['request'];

    switch ($request)
    {
        case 'login':

            beginSession();
            $code = studentLogin();
            $respond->loginResponse($code, $GLOBALS['_student']);
            break;
            
        case 'logout':

            beginSession();
            $code = studentLogout();
            $respond->logoutResponse($code);
            
            break;

        case 'register':
            $code = registerStudent();
            $respond->registrationResponse($code, $GLOBALS['_student']);
            break;

        case 'status':
        	beginSession();
        	$code = loginStatus();
        	$respond->otherResponse($code, null);
            break;
            
        case 'student_info':
            break;

        case "share":
            beginSession();
            $code = upload( $_FILES['file']);
            $respond->uploadResponse($code, null);
            break;

        case "stream":
            stream();//(int)$_POST['IdPhoto']);
            break;

        case "house_info":

            break;

        default:
            break;
    }
}
else
{
    /**
     * Request get function is not set
     * Handle error
     */

    echo 'No Request Set';


}

/**
 * Functions to be called in the switch cases
 */

/*
 * Session start function
 * Call begin session whenever needed
 * because you don't want
 * to create a lot of useless sessions
 */
function beginSession()
{
    $session = new Session();
    // Set to true if using https
    $session->start_session('_s',false);
}

/**
 * login student
 */

function studentLogin()
{
    $student = new Student(); 
    //$student->construct($_GET); //TEST
    $student->construct($_POST); //RELEASE
    
    $loginController = new LoginController($student);
    
    
    $return = $loginController->beginLoginFlow();
    
    if ($return != 1001 && $return != 1006 && $return != 1002)
    {
	    $GLOBALS['_student'] = $return;
	    return 1005;
    }
    return $return;
}

/**
 * Register student
 */

function registerStudent()
{
    $student = new Student();
    //$student->construct($_GET); //TEST
    $student->construct($_POST); //RELEASE
    
    $registrationController = new RegistrationController($student);
    $GLOBALS['_student'] = $student;
    return $registrationController->beginRegistrationFlow();
}

function loginStatus()
{
	$loginController = new LoginController(null);
    return $loginController->checkLoginStatus();
}

function studentLogout()
{
	$loginController = new LoginController(null);
    return $loginController->beginLogoutFlow();
}


function upload( $photoData) {
    //check if a user ID is passed
    if (!$_SESSION['studentId']) if (!isset($_GET['dev'])) return 5001;

    //check if there was no error during the file upload
    if ($photoData['error'] == 0) {

        $houseImage = new HouseImage();
        $houseImage->construct(json_decode(stripslashes($_POST['house_image']), true), $photoData);

        $workPlace = new Company();
        $workPlace->construct(json_decode(stripslashes($_POST['company']), true));

        $house = new House();
        $house->construct(json_decode(stripslashes($_POST['house']), true));

        $houseExtra = new HouseExtra();
        $houseExtra->construct(json_decode(stripslashes($_POST['description']), true));

        $owner = new HouseOwner();
        $owner->construct(json_decode(stripslashes($_POST['owner']), true));

        $post = new Post(array( 'hi' => $houseImage,
                                'w' => $workPlace,
                                'h' => $house,
                                'he' => $houseExtra,
                                'o' => $owner));

        $code = $post->beginHousePostFlow();

        return $code;

    } else {
        return 5003;
    }
}

function stream($IdPhoto=0) {
    $da = new DataAccessor();
    $da->streamHouses();
}


//function getHouseInfoBy($by, )
//{
//    $da = new DataAccessor();
//    $da->streamHouses();
//}


?>