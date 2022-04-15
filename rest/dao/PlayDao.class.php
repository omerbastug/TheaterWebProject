<?php
require_once __DIR__."/BaseDao.class.php";

class PlayDao extends BaseDao {
    public function __construct(){
        parent::__construct("play");
    }
}
?>