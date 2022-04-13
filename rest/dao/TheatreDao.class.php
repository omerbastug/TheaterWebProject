<?php
require_once __DIR__."/BaseDao.class.php";

class TheatreDao extends BaseDao {
    public function __construct(){
        parent::__construct("theatre");
    }
}
?>