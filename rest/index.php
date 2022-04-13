<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\cinemaProject\rest\routes\PersonRoutes.php';
require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\cinemaProject\rest\routes\SessionsRoutes.php';
require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\cinemaProject\rest\routes\TicketsRoutes.class.php';

Flight::register('projectdao', 'ProjectDao');


// Ticket Purchase
Flight::route('POST /purchase', function(){
    Flight::projectdao()->PurchaseTicket(Flight::request()->data->getData());
});


//Gets sessions
Flight::route('GET /sessions',function(){
    Flight::json(Flight::projectdao()->getSessionsInfo());
});

// Gets seat info
Flight::route('GET /theatre/@id',function($id){
    Flight::json(Flight::projectdao()->getTheatreRowColumn($id));
});

// Gets sold tickets info
Flight::route('GET /ticketssold/@id',function($id){
    Flight::json(Flight::projectdao()->ticketsSold($id));
});

Flight::route('POST /isaperson/@email',function($email){
    Flight::json(Flight::projectdao()->IsAperson($email));
});


Flight::start();
?>