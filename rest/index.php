<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/ProjectDao.class.php';
require_once '../vendor/autoload.php';

Flight::route('/',function(){
    echo "hello world trials";
});

Flight::start();
?>