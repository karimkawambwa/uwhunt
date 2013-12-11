<?php
/**
 * Created by PhpStorm.
 * User: kayr1m
 * Date: 11/26/13
 * Time: 1:38 PM
 */

class HouseImage {
    public $image_id;
    public $house_id;
    public $image_name;
    public $image;
    public $image_url;
    public $thumbnail_url;

    public function __construct(){

    }

    public function construct($obj, $img)
    {
        $this->image_name = $obj['image_title'];
        $this->image = $img;
    }
}

?>