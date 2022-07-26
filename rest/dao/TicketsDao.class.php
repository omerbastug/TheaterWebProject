

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
    public function bulkAdd($bulk, $userid){
        $bind = ["userid" => $userid];
        $query = "INSERT INTO ticketspurchased
        (
        `session_id`, 
        `seatRow`, 
        `seatColumn`, 
        `personID`
        )
        VALUES ";
        for ($i = 0 ; $i < count($bulk); $i++){
            $query.="
            (
            :session".$i.", 
            :seatRow".$i.", 
            :seatColumn".$i.", 
            :userid
            ),
        ";
        $bind += ["session".$i => $bulk[$i]["session_id"], "seatRow".$i => $bulk[$i]["seat_row"],"seatColumn".$i => $bulk[$i]["seat_column"]];
        }
        substr($query, 0, -1);
        $query.=";";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($bind);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
}
?>