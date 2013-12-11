<?php
/**
 * Created by Karim Kawambwa using PhpStorm.
 * User: kayr1m
 * Date: 11/16/13
 * Time: 5:05 PM
 */

class Database {
    protected $_host;
    protected $_database;
    protected $_user;
    protected $_password;
    protected $_connection;

    public function __construct(
        $host = 'localhost',
        $database = 'chataloo_HUNTDev',
        $user = 'chataloo_hdev',
        $password = 'huntdev2013'
    )
    {
        $this->_host   = $host;
        $this->_database = $database;
        $this->_user     = $user;
        $this->_password = $password;
    }

    public function openConnection(){
        try{
            $this->_connection = new PDO('mysql:host='.$this->_host.';dbname='.$this->_database,
                $this->_user, $this->_password);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: '. $e->getMessage();
        }
    }

    public function endConnection(){
        $this->_connection = null;
    }
}

?>