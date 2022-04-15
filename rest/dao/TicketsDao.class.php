

<?php
require_once __DIR__."/BaseDao.class.php";

class TicketsDao extends BaseDao {
    public function __construct(){
        parent::__construct("ticketspurchased");
    }

    public function getBysessID($id){
        return $this->queryID("SELECT * FROM ticketspurchased WHERE session_id = :id",$id);
    }
}
?>