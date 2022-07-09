

<?php
require_once __DIR__."/BaseDao.class.php";

class TicketsDao extends BaseDao {
    public function __construct(){
        parent::__construct("ticketspurchased");
    }
    public function getBysessID($id){
        return $this->queryID('SELECT CONCAT(seatRow,",", seatColumn) as seat FROM ticketspurchased WHERE session_id = :id',$id);
    }
    public function getSpecific($params){
        return $this->query("SELECT id  FROM ticketspurchased WHERE session_id = :sessid AND seatRow = :seatrow AND seatColumn = :seatcol",$params);
    }
    public function IsAperson($id){
        $stmt = $this->conn->prepare("SELECT * FROM person WHERE id = :id ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
}
?>