<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__).'\rest\dao\ProjectDao.class.php';
$con = new ProjectDao(); 
$con->deleteByID(12);
$con->deleteByPlayID(2);
$con->deleteBySessionsID(3);
print_r($con->getper());
?>