<?php

class ProjectDao {

    private $conn;

    public function __construct(){

        $servername = "localhost";
        $username = "freedb_projectAdmin";
        $password = "NkpGEJ*wV4m@E7J";
        $database = "cinemaproject";
        $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function addtoPerson($name,$surname,$role,$email){
        $stmt = $this->conn->prepare("INSERT INTO person (Name, Surname, Role_id, email) VALUES (:name, :surname, :role, :email)");
        $stmt->execute(['name' => $name, 'surname' => $surname, 'role' => $role, 'email' => $email]);
    }


}

?>