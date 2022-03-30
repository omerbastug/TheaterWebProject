<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'dao/ProjectDao.class.php';
require_once '../vendor/autoload.php';
Flight::register('projectdao', 'ProjectDao');

// Ticket Purchase
Flight::route('POST /purchase', function(){
    Flight::projectdao()->PurchaseTicket(Flight::request()->data->getData());
});

// Prints person Table
Flight::route('GET /person', function(){
    Flight::json(Flight::projectdao()->getper());
});

// Adds Person to person table
Flight::route('POST /newperson', function(){
    Flight::json(Flight::projectdao()->addtoPerson(Flight::request()->data->getData()));
});

// Changes email of person with id
Flight::route('PUT /updateEmail/@id', function($id){
    Flight::projectdao()->updateEmailOnID($id, Flight::request()->data->getData());
});

Flight::route('GET /sessions',function(){
    Flight::json(Flight::projectdao()->getSessionsInfo());
});

Flight::route('GET /theatre/@id',function($id){
    Flight::json(Flight::projectdao()->getTheatreRowColumn($id));
});

Flight::route('GET /ticketssold/@id',function($id){
    Flight::json(Flight::projectdao()->ticketsSold($id));
});
Flight::start();
?>