<?php
require_once 'C:\Bitnami\wampstack-8.1.2-0\apache2\htdocs\cinemaProject\rest\services\PersonService.class.php';
require_once __DIR__.'/../Config.class.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
Flight::register('persondao', 'PersonService');

// Prints person Table
Flight::route('GET /get/person', function(){
    Flight::json(Flight::persondao()->getAllFromTable());
});

Flight::route('GET /get/person/@id', function($id){
    Flight::json(Flight::persondao()->getByID($id));
  });

Flight::route('GET /get/isaperson/@email', function($email){
   Flight::json(Flight::persondao()->IsAperson($email));
 });
// Adds Person to person table
Flight::route('POST /add/person', function(){
    Flight::json(Flight::persondao()->add(Flight::request()->data->getData()));
});

// Updates person
Flight::route('PUT /update/person/@id', function($id){
    Flight::persondao()->update($id, Flight::request()->data->getData());
});

// Deletes person by id
Flight::route('PUT /delete/person/@id', function($id){
    Flight::persondao()->deleteByID($id);
});

Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $user = Flight::persondao()->IsAperson($login['email']);
    if (isset($user[0]['id'])){
      if($user[0]['password'] == $login['password']){
        unset($user[0]['password']);
        $jwt = JWT::encode($user[0], Config::JWT_SECRET(), 'HS256');
        Flight::json(['token' => $jwt]);
      } else {
        Flight::json(["message" => "Wrong password"], 404);
      }
    } else {
      Flight::json(["message" => "User doesn't exist"], 404);
    }
});

Flight::route('POST /auth', function(){
  $secret = Config::JWT_SECRET();
  $dataa = Flight::request()->data->getData();
  $decoded = (array) JWT::decode($dataa['token'], new Key($secret, 'HS256')) ;
  $newww = Flight::persondao()->IsAperson($decoded["email"]);
  $user = $newww[0];
  if ($user['email'] == $decoded["email"]){
    return true;
  } else { 
    return false; 
  }
});
?>