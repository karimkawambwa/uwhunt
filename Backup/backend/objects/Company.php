<?php
/**
 * Created by PhpStorm.
 * User: kayr1m
 * Date: 11/26/13
 * Time: 1:38 PM
 */

class Company {
    public $company_id;
    public $name;
    public $city;
    public $country;
    public $full_address;
    public $postal_code;

    public function __construct(){

    }

    public function construct($obj)
    {
        $this->company_id = '';
        $this->name =  $obj['company_name'];
        $this->city = $obj['company_country'];
        $this->country = $obj['company_city'];
        $this->full_address = $obj['company_full_address'];
        $this->postal_code = $obj['company_postal_code'];

    }
}

?>