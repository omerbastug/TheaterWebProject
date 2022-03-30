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

    public function addtoPerson($person){
        $stmt = $this->conn->prepare("INSERT INTO person (name, surname, email) VALUES (:name, :surname, :email)");
        $stmt->execute($person);
        echo "New Person added to person table.";
    }

    public function addtoPlays($play){
        $stmt = $this->conn->prepare("INSERT INTO sessions (name, author, durationMinutes, asd) VALUES (:name, :author, :durationMinutes, :asd)");
        $stmt->execute($play);
        echo "New Play added to play table.";
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

    public function getsessions(){
        $stmt = $this->conn->prepare("SELECT * FROM sessions");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function updateEmailOnID($id , $email){
        $stmt = $this->conn->prepare("UPDATE person SET email = :email WHERE id = :id");
        $stmt->execute(['id' => $id , 'email' => $email['email']]);
    }

    
    public function deleteByID($id) {
        $stmt = $this->conn->prepare("DELETE FROM person WHERE id = :id");
        $stmt->execute(['id' => $id]);
        echo "Deleted";
    } 

    public function deleteByPlayID($id) {
        $stmt = $this->conn->prepare("DELETE FROM play WHERE id = :id");
        $stmt->execute(['id' => $id]);
        echo "Deleted";
    }

    public function deleteBySessionsID($id) {
        $stmt = $this->conn->prepare("DELETE FROM sessions WHERE id = :id");
        $stmt->execute(['id' => $id]);
        echo "Deleted";
    }
    

    public function PurchaseTicket($info){
        $q1 = "INSERT INTO ticketsPurchased (session_id, seatRow, seatColumn, personID) VALUES (:sessionID, :seatrow, :seatcolumn, :personID);";
        $q2 = "UPDATE sessions SET ticketsAvailable = ticketsAvailable-1 WHERE id = :sessionID;";
        $stmt = $this->conn->prepare($q1);
        $stmt->execute($info); 
        $stmt = $this->conn->prepare($q2);
        $stmt->execute(['sessionID' => $info["sessionID"]]);
        echo "purhcased";
    }
}

?>