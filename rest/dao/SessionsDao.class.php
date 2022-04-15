<?php
require_once __DIR__."/BaseDao.class.php";

class SessionsDao extends BaseDao {
    public function __construct(){
        parent::__construct("sessions");
    }
    public function getAllFromTable(){
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->table." as ss join play as pl where ss.play_id = pl.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>