<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__).'\rest\dao\ProjectDao.class.php';
$con = new ProjectDao(); 
$con->updateEmailOnID("3","new@email");
print_r($con->getper());
?>