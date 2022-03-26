<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/ProjectDao.class.php';
require_once '../vendor/autoload.php';
Flight::register('projectdao', 'ProjectDao');


Flight::route('POST /purchase', function(){
    Flight::projectdao()->PurchaseTicket(Flight::request()->data->getData());
});


Flight::route('/',function(){
    echo "hello world trials";
});

Flight::start();
?>