<?php
/**
 * Created by Karim Kawambwa using PhpStorm.
 * User: kayr1m
 * Date: 11/16/13
 * Time: 4:59 PM
 */

class Student{
    public $student_id;
    public $first_name;
    public $last_name;
    public $username;
    public $student_password;
    public $salt;
    public $student_email;
    public $student_phone;

    public function __construct(){
       
    }
    
    public function construct($obj)
    {
	    $this->student_id = '';
        $this->first_name = $obj['firstname'];
        $this->last_name = $obj['lastname'];
        $this->username = $obj['username'];
        $this->student_password = $obj['password'];
        $this->salt = '';
        $this->student_email = $obj['email'];
        $this->student_phone = $obj['phone'];

    }

}
?>