<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\cinemaProject\rest\routes\PersonRoutes.php';
require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\cinemaProject\rest\routes\SessionsRoutes.php';
require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\cinemaProject\rest\routes\TicketsRoutes.class.php';
require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\cinemaProject\rest\routes\TheatreRoutes.class.php';

Flight::start();
?>