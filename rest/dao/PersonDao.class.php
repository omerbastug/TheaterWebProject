<?php
require_once __DIR__."/BaseDao.class.php";

class PersonDao extends BaseDao {
    public function __construct(){
        parent::__construct('person');
    }



    public function getSessionsInfo(){
        $stmt = $this->conn->prepare("SELECT pl.name, ss.time, ss.ticketsAvailable, pl.durationMinutes, ss.theatre_id ,ss.id
        FROM sessions as ss
        JOIN play as pl on pl.id = ss.play_id;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function IsAperson($email){
        $stmt = $this->conn->prepare("SELECT * FROM person WHERE email= :email ");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
}
?>