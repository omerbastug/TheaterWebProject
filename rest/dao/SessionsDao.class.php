<?php
require_once __DIR__."/BaseDao.class.php";

class SessionsDao extends BaseDao {
    public function __construct(){
        parent::__construct("sessions");
    }
}
?>