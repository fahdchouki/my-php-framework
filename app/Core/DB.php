<?php 

class DB 
{
    protected $db;

    public function connect()
    {
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        try{
            $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,DB_USER,DB_PASS,$options);
        }catch(PDOException $ex){

        }

        return $this->db;
    }


}