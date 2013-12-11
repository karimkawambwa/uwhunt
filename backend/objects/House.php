<?php
/**
 * Created by Karim Kawambwa using PhpStorm.
 * User: kayr1m
 * Date: 11/16/13
 * Time: 5:00 PM
 */

class House {
    public $house_id;
    public $owner_id;
    public $country;
    public $city;
    public $province;
    public $postal_code;
    public $full_address;
    public $occupant_capacity;
    public $date_added;
    public $rent_price;
    public $last_edited;

    public function __construct(){

    }

    public function construct($obj)
    {
        $this->house_id = '';
        $this->owner_id = '';
        $this->country = $obj['house_country'];
        $this->city = $obj['house_city'];
        $this->province = $obj['house_province'];
        $this->postal_code = $obj['house_postal_code'];
        $this->full_address = $obj['house_full_address'];
        $this->occupant_capacity = $obj['house_occupant_capacity'];
        $this->date_added = $obj['house_date_added'];
        $this->rent_price = $obj['house_rent_price'];
        $this->last_edited = $obj['house_last_edited'];

    }

}

class HouseExtra{
    public $house_id;
    public $house_description;
    public $house_mentions;
    public $house_hash_tags;

    public function __construct(){

    }

    public function construct($obj)
    {
    	$this->house_mentions = array();
    	$this->house_hash_tags = array();
    	
        $this->house_mentions = $obj['mention_tags'][0];
        $this->house_hash_tags = $obj['hash_tags'][0];
        $this->house_description = $obj['house_description'];
    }

}

?>