

<?php
require_once __DIR__."/BaseDao.class.php";

class TicketsDao extends BaseDao {
    public function __construct(){
        parent::__construct("ticketspurchased");
    }

    public function getBysessID($id){
        return $this->query("SELECT * FROM ticketspurchased WHERE sess_id = :id",$id);
    }
}
?>