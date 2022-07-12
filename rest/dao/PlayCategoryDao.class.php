<?php
require_once __DIR__."/BaseDao.class.php";

class PlayCategoryDao extends BaseDao {
    public function __construct(){
        parent::__construct("playcategory");
    }
}
?>