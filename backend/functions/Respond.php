<?php
/**
 * Created by Karim Kawambwa PhpStorm.
 * User: kayr1m
 * Date: 11/16/13
 * Time: 11:21 PM
 */
class Respond{

    /*
     * PRIVATE FUNCTIONS
     */

    private function commonResponse( $code, $extra_param = null, $isError = false, $message = null)
    {
        $responseType = 'success';
        if ($isError)
        {
            $responseType = 'error';
        }
        
        

        if ($extra_param == null){
            return json_encode(array("response"    =>  $responseType,
                $responseType =>  $code,
                "message"     =>  $message
            ));
        }
        else
        {
            return json_encode(array_merge( array("response"    =>  $responseType,
                $responseType =>  $code,
                "message"     =>  $message
            ), $extra_param));
        }
    }

    private function studentExtraMap($student)
    {
        if ($student != null){
            $extraMap['extra_map'] = array(
                "username" => $student->student_email,
                "first_name" => $student->first_name,
                "last_name" => $student->last_name,
                "student_email" => $student->student_email,
                "student_phone" => $student->student_phone
            );
        }
        else
        {
            $extraMap['extra_map'] = null;
        }

        return $extraMap;
    }

    /*
     * PUBLIC FUNCTIONS
     */


    public function loginResponse($code, $student = null)
    {
        switch ($code){
            case 1001: // LOGIN ERROR WRONG USERNAME, EMAIL OR PASSWORD
                $json = $this->commonResponse($code, null, true,'Wrong username or password. ('.$code.')' );
                echo $json;
                break;

            case 1002: // LOGIN ERROR ALREADY LOGGED IN
                $json = $this->commonResponse($code, null, true,'Student is already logged in. ('.$code.')' );
                echo $json;
                break;

            case 1003: // LOGIN ERROR STUDENT IS BANNED
                $json = $this->commonResponse($code, null, true,
                    'Student is banned for reasons in terms and conditions. If this is a mistake the contact us. ('.$code.')' );
                echo $json;
                break;

            case 1004: // LOGIN ERROR STUDENT HAS NOT VERIFIED EMAIL
                $json = $this->commonResponse($code, null, true,
                    'Verify email before login. Tap Resend email if you did not receive email. ('.$code.')' );
                echo $json;
                break;

            case 1005: // SUCCESSFUL LOGIN
                $extra_param = $this->studentExtraMap($student);
                $json = $this->commonResponse($code, $extra_param, false, 'Successfully logged in. ('.$code.')' );
                echo $json;
                break;

            default:
                break;
        }
    }

    public function registrationResponse($code, $student = null)
    {
        switch ($code){
            case 2001: // REGISTRATION ERROR USERNAME IS TAKEN
                $json = $this->commonResponse($code, null, true,'Username has been taken. ('.$code.')' );
                echo $json;
                break;

            case 2002: // REGISTRATION ERROR EMAIL IS REGISTERED
                $json = $this->commonResponse($code, null, true,'Email has already been registered. ('.$code.')' );
                echo $json;
                break;

            case 2003: // REGISTRATION ERROR EMAIL IS REGISTERED AN BANNED
                $json = $this->commonResponse($code, null, true,
                    'Cannot register with this email, it has been black listed. ('.$code.')' );
                echo $json;
                break;

            case 2004: // SUCCESSFUL REGISTRATION
                $extra_param = $this->studentExtraMap($student);
                $json = $this->commonResponse($code, $extra_param, false, 'Successfully registered. ('.$code.')' );
                echo $json;
                break;

            case 2005: // ERROR ON DB ACCESSOR
                break;

            default:
                break;
        }
    }

    public function logoutResponse($code)
    {
        switch ($code){
            case 4001: // LOGOUT SUCCESS
                $json = $this->commonResponse($code, null, true,'Logged out. ('.$code.')' );
                echo $json;
                break;

            case 4002: // LOGOUT FAIL
                $json = $this->commonResponse($code, null, true,'Logout failed. ('.$code.')' );
                echo $json;
                break;

            default:
                break;
        }
    }

    public function uploadResponse($code)
    {
        switch ($code){
            case 5001: // Upload failed not authorized
                $json = $this->commonResponse($code, null, true,'Not authorized. ('.$code.')' );
                echo $json;
                break;

            case 5002: // Upload database problem.
                $json = $this->commonResponse($code, null, true,'Upload database problem. ('.$code.')' );
                echo $json;
                break;

            case 5003: // Upload malfunction
                $json = $this->commonResponse($code, null, true,'Upload malfunction. ('.$code.')' );
                echo $json;
                break;

            case 5004: // Upload failed not authorized
                $json = $this->commonResponse($code, null, true,'Not authorized. ('.$code.')' );
                echo $json;
                break;

            case 5005: // Failed creating owner
                $json = $this->commonResponse($code, null, true,'Failed creating owner. ('.$code.')' );
                echo $json;
                break;

            case 5006: // Failed creating house
                $json = $this->commonResponse($code, null, true,'Failed creating house. ('.$code.')' );
                echo $json;
                break;

            case 5007: // Failed saving image
                $json = $this->commonResponse($code, null, true,'Failed saving image. ('.$code.')' );
                echo $json;
                break;

            case 5008: // Failed creating company
                $json = $this->commonResponse($code, null, true,'Failed creating company. ('.$code.')' );
                echo $json;
                break;

            case 5009: // Failed linking employment
                $json = $this->commonResponse($code, null, true,'Failed linking employment. ('.$code.')' );
                echo $json;
                break;

            case 5010: // Success saving image
                $json = $this->commonResponse($code, null, true,'Success saving image. ('.$code.')' );
                echo $json;
                break;

            case 5011: // Success posting house
                $json = $this->commonResponse($code, null, true,'Successfully posted house. ('.$code.')' );
                echo $json;
                break;
                
            case 5012: // failed hashtags or mentions
                $json = $this->commonResponse($code, null, true,'Failed hashtags or mentions. ('.$code.')' );
                echo $json;
                break;

            default:
                break;
        }
    }

    public function otherResponse($code, $student = null)
    {
        switch ($code)
        {
            case 3001: // NO $_GET REQUEST SET
                $json = $this->commonResponse($code, null, true,
                    'No request provided. Get the list of requests http://chataloo-hunt.com/uwhunt/api/Request.php?request=api .('.$code.')' );
                echo $json;
                break;

            case 3002: // NO $_POST SET
                $json = $this->commonResponse($code, null, true,'POST has not been set. ('.$code.')' );
                echo $json;
                break;

            case 3003: // GET USER STATUS OR STUDENT INFO RESPONSE
                $extra_param = $this->studentExtraMap($student);
                $json = $this->commonResponse($code, $extra_param);
                echo $json;
                break;
                
            case 1002: // LOGIN USER STATUS ALREADY LOGGED IN
                $json = $this->commonResponse($code, null, true,'Student is already logged in. ('.$code.')' );
                echo $json;
                break;

            case 3004: // LOGIN USER STATUS ALREADY LOGGED IN
                $json = $this->commonResponse($code, null, true,'No log in. ('.$code.')' );
                echo $json;
                break;

            default:
                break;
        }
    }
}

?>