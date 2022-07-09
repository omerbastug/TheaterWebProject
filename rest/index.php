<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../vendor/autoload.php';
require_once __DIR__.'\routes\ApiSpec.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('/*', function(){
    //perform JWT decode
    $path = Flight::request()->url;
    if ($path == '/login' || $path == '/register' || $path == '/docs.json') return TRUE; // exclude login route from middleware
    
    $headers = getallheaders();
    if (@!$headers['Authorization']){
      Flight::json(["message" => "Authorization is missing"], 403);
      return FALSE;
    }else{
      try {
        $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
        Flight::set('user', $decoded);
        return TRUE;
      } catch (\Exception $e) {
        Flight::json(["message" => "Authorization token is not valid"], 403);
        return FALSE;
      }
    }
  });

/* REST API documentation endpoint */
Flight::route('GET /docs.json', function(){
  $openapi = \OpenApi\scan('routes');
  header('Content-Type: application/json');
  echo $openapi->toJson();
});

require_once __DIR__.'\routes\PersonRoutes.php';
require_once __DIR__.'\routes\SessionsRoutes.php';
require_once __DIR__.'\routes\TicketsRoutes.php';
require_once __DIR__.'\routes\TheatreRoutes.php';
require_once __DIR__.'\routes\PlayRoutes.php';

Flight::start();
?>