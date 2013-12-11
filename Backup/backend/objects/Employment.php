<?php
/**
 * Created by PhpStorm.
 * User: kayr1m
 * Date: 11/26/13
 * Time: 2:07 PM
 */

class Employment {
    public $employment_id;
    public $student_id;
    public $house_id;
    public $company_id;
    public $position;
    public $start_date;
    public $end_date;

    public function __construct(){

    }

    public function construct($obj)
    {
        $this->position = $obj['position'];
        $this->start_date = $obj['start_date'];
        $this->end_date = $obj['end_date'];

    }


} 