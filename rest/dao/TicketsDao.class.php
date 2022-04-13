

<?php
require_once __DIR__."/BaseDao.class.php";

class TicketsDao extends BaseDao {
    public function __construct(){
        parent::__construct("ticketssold");
    }

    public function getBysessID($id){
        return $this->query("SELECT * FROM ticketssold WHERE sess_id = :id",$id);
    }
}
?>