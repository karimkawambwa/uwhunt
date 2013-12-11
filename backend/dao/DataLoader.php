<?php
/**
 * Created by PhpStorm.
 * User: kayr1m
 * Date: 12/11/13
 * Time: 10:18 AM
 */

include_once 'lib/Database.php';

class DataLoader extends Database {

    function __construct()
    {
        parent::__construct();
    }

    public function getHouses()
    {
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            $stmt = $dbConnection->prepare("SELECT * FROM House INNER JOIN House_Image 											ON House_Image.house_id = House.house_id 
            								ORDER BY House.house_id DESC LIMIT 50");


            $stmt->execute();
            $result = $stmt->fetchAll();

            //return $result;
            echo json_encode($result);

            return null;


        } catch(PDOException $e) {
            error_log( 'Error getting houses: ' . $e->getMessage(),
                1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return 6000;
        }
    }

    public function getHouseDescription(){
        $this->openConnection();
        $dbConnection = $this->_connection;

        try{
            $stmt = $dbConnection->prepare("SELECT * FROM House_Ta
                                            INNER JOIN House_Image 
                                            ON House_Image.house_id = House.house_id
                                            ORDER BY House.house_id DESC LIMIT 50");


            $stmt->execute();
            $result = $stmt->fetchAll();

            //return $result;
            echo json_encode($result);

            return null;


        } catch(PDOException $e) {
            error_log( 'Error getting houses: ' . $e->getMessage(),
                1,"abdul-karym@hotmail.com","From: webmaster@error.com") ;
            return 6000;
        }
    }
}
?>