<?php
/**
 * Created by PhpStorm.
 * User: kayr1m
 * Date: 12/4/13
 * Time: 2:32 PM
 */

include_once 'dao/DataLoader.php';

class DataAccessor {
    public $dataLoader;
    function __construct()
    {
        $this->dataLoader = new DataLoader();
    }

    public function streamHouses()
    {
        $return = $this->dataLoader->getHouses();

        return $return;
    }

    public function getHouseDescriptionById($id)
    {
        $return = $this->dataLoader->getHouseDescription();

        return $return;
    }

}

?>