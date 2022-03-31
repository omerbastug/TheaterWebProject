<?php

class ProjectDao {

    private $conn;

    public function __construct(){

        $servername = "localhost";
        $username = "newuser";
        $password = "admin";
        $database = "cinemaproject";
        $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function addtoPerson($name,$surname,$role,$email){
        $stmt = $this->conn->prepare("INSERT INTO person (Name, Surname, Role_id, email) VALUES (:name, :surname, :role, :email)");
        $stmt->execute(['name' => $name, 'surname' => $surname, 'role' => $role, 'email' => $email]);
    }



    public function getAllFromTable($pe){
        $stmt = $this->conn->prepare("SELECT * FROM :p");
        $stmt->execute(['p' => $pe]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getper(){
        $stmt = $this->conn->prepare("SELECT * FROM person");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function updateEmailOnID($id , $email){
        $stmt = $this->conn->prepare("UPDATE person SET email = :email WHERE id = :id");
        $stmt->execute(['id' => $id , 'email' => $email]);
    }

    public function deleteByID($id) {
        $stmt = $this->conn->prepare("DELETE FROM person WHERE id = :id");
        $stmt->execute(['id' => $id]);
    } 
    public function getSessionsInfo(){
        $stmt = $this->conn->prepare("SELECT pl.name, ss.time, ss.ticketsAvailable, pl.durationMinutes, ss.theatre_id ,ss.id
        FROM sessions as ss
        JOIN play as pl on pl.id = ss.play_id;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTheatreRowColumn($id){
        $stmt = $this->conn->prepare("SELECT numberofrows,numberofcolumn FROM theatre WHERE id =:id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ticketsSold($ses_id){
        $stmt = $this->conn->prepare("SELECT seatRow,seatColumn FROM ticketspurchased WHERE session_id =:id");
        $stmt->execute(['id' => $ses_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
}

?>