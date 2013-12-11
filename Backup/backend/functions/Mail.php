<?php
/**
 * Created by Karim Kawambwa PhpStorm.
 * User: kayr1m
 * Date: 11/16/13
 * Time: 11:20 PM
 */

class Mail{

    /*
     * PUBLIC FUNCTIONS
     * Mail to Student
     */
    public function mailSuccessfulEmailVerification($email)
    {

    }

    public function  mailVerificationWithCode($email, $verification_code){

    }

    public function mailStudentBanned($email)
    {

    }

    public function mailResetPassword($email, $tempPass)
    {

    }

    /*
     * PUBLIC FUNCTIONS
     * Mail to Hunt Team
     */

    public function mailHuntOnNewReg($student)
    {

    }

    public function mailHuntOnNewHousePost($house, $student)
    {

    }

    public function mailHuntOnError($error)
    {

    }

    /*
     * PRIVATE FUNCTIONS
     */

    private function _mail($to, $subject, $message, $headers)
    {
        if (@mail($to, $subject, $message, $headers))
        {
            /*
             * Successfully sent mail
             */
            return true;
        }
        else{
            /*
             * Failed sending mail
             */
            return false;
        }
    }

}

?>