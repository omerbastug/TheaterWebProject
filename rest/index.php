<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
Flight::route('/*', function(){
    //perform JWT decode
    $path = Flight::request()->url;
    print_r($path);
    if ($path == '/login') return TRUE; // exclude login route from middleware
    
    $headers = getallheaders();
    print_r($headers);
    if (@!$headers['Authorization']){
      Flight::json(["message" => "Authorization is missing"], 403);
      return FALSE;
    }else{
      try {
        $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
        print_r($decoded);
        Flight::set('user', $decoded);
        return TRUE;
      } catch (\Exception $e) {
        Flight::json(["message" => "Authorization token is not valid"], 403);
        return FALSE;
      }
    }
  });

require_once __DIR__.'\routes\PersonRoutes.php';
require_once __DIR__.'\routes\SessionsRoutes.php';
require_once __DIR__.'\routes\TicketsRoutes.class.php';
require_once __DIR__.'\routes\TheatreRoutes.class.php';

Flight::start();
?>