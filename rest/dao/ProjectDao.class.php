<?php

class Dao {

    private $connection;

    public function __construct(){

        $servername = "sql.freedb.tech";
        $username = "freedb_projectAdmin";
        $password = "NkpGEJ*wV4m@E7J";
        $database = "freedb_IntroToWebProject";
  
        $this->connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        
        // set the PDO error mode to exception
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    }


}

?>