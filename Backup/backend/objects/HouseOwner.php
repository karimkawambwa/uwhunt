<?php
/**
 * Created by PhpStorm.
 * User: kayr1m
 * Date: 11/26/13
 * Time: 1:51 PM
 */

class HouseOwner {
    public $owner_id;
    public  $owner_name;
    public  $owner_email;
    public  $phone_number;

    public function __construct(){

    }

    public function construct($obj)
    {
        $this->owner_id = '';
        $this->owner_name = $obj['owner_name'];
        $this->owner_email = $obj['owner_email'];
        $this->phone_number = $obj['owner_phone'];

    }
}

?>