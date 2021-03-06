<?php
require_once __DIR__.'/../services/PersonService.class.php';
require_once __DIR__.'/../Config.class.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
Flight::register('persondao', 'PersonService');

/**
 * @OA\Get(path="/get/person", tags={"person"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all user persons from the API. ",
 *         @OA\Response( response=200, description="List of users.")
 * )
 */
// Prints person Table
Flight::route('GET /get/person', function(){
    Flight::json(Flight::persondao()->getAllFromTable());
});
/**
 * @OA\Get(path="/get/person/actor", tags={"person"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all user actors from the API. ",
 *         @OA\Response( response=200, description="List of actors.")
 * )
 */
// Prints person Table
Flight::route('GET /get/person/actor', function(){
  Flight::json(Flight::persondao()->getActors());
});
/**
 * @OA\Get(path="/get/person/{id}", tags={"person"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Id of person"),
 *         summary="Return person with the ID from the API. ",
 *         @OA\Response( response=200, description="Person's ID")
 * )
 */
Flight::route('GET /get/person/@id', function($id){
    Flight::json(Flight::persondao()->getByID($id));
  });
/**
 * @OA\Get(path="/get/user/{id}", tags={"person"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Id of person"),
 *         summary="Return person with the ID from the API. ",
 *         @OA\Response( response=200, description="Person's ID")
 * )
 */
Flight::route('GET /get/user/', function(){
  Flight::json(Flight::persondao()->getByID(Flight::get('user')['id']));
});

/**
 * @OA\Get(path="/get/isaperson/{email}", tags={"person"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="email", example=1, description="email of person"),
 *         summary="Return person with the email from the API. ",
 *         @OA\Response( response=200, description="Person with the email")
 * )
 */
Flight::route('GET /get/isaperson/@email', function($email){
   Flight::json(Flight::persondao()->IsAperson($email));
 });

/**
* @OA\Post(
*     path="/add/person", 
*     description="Add user",
*     tags={"person"},
*     @OA\RequestBody(description="Basic person info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="Omer",	description="Name of person"),
*    				@OA\Property(property="surname", type="string", example="Bastug",	description="Surname of person" ),
*           @OA\Property(property="email", type="string", example="omerbastug@email.com",	description="Email" ),
*           @OA\Property(property="password", type="string", example="omer123",	description="Password" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Person has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
// Adds Person to person table
Flight::route('POST /add/person', function(){
    $entity = Flight::request()->data->getData();
    if($entity['role_id']==2){
      Flight::json(Flight::persondao()->add($entity));
    } else if(Flight::get('user')['role_id']==5){ // Admin Check
      Flight::json(Flight::persondao()->add($entity));
    } else {
      throw new Exception("Unauthorized");
    }
    
});
Flight::route('POST /register', function(){
    Flight::json(Flight::persondao()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/update/person/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update person",
*     tags={"person"},
*     @OA\Parameter(in="path", name="id", example=1, description="Person ID"),
*     @OA\RequestBody(description="Basic person info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="Omer",	description="Name of person"),
*    				@OA\Property(property="surname", type="string", example="Bastug",	description="Surname of person" ),
*           @OA\Property(property="email", type="string", example="omerbastug@email.com",	description="Email" ),
*           @OA\Property(property="password", type="string", example="omer123",	description="Password" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Person that has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
// Updates person
Flight::route('PUT /update/person/@id', function($id){
    Flight::persondao()->update($id, Flight::request()->data->getData());
});

/**
* @OA\Put(
*     path="/update/user", security={{"ApiKeyAuth": {}}},
*     description="Update user",
*     tags={"person"},
*     @OA\Parameter(in="path", name="id", example=1, description="Person ID"),
*     @OA\RequestBody(description="Basic person info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="Omer",	description="Name of person"),
*    				@OA\Property(property="surname", type="string", example="Bastug",	description="Surname of person" ),
*           @OA\Property(property="email", type="string", example="omerbastug@email.com",	description="Email" ),
*           @OA\Property(property="password", type="string", example="omer123",	description="Password" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Person that has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
// Updates person
Flight::route('PUT /update/user', function(){
  Flight::persondao()->update(Flight::get('user')['id'], Flight::request()->data->getData());
});

/**
* @OA\DELETE(
*     path="/delete/person/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete person",
*     tags={"person"},
*     @OA\Parameter(in="path", name="id", example=1, description="Person ID"),
*     @OA\Response(
*         response=200,
*         description="Person that has been deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
// Deletes person by id
Flight::route('PUT /delete/person/@id', function($id){
    Flight::persondao()->deleteByID($id);
});

/**
* @OA\POST(
*     path="/login", 
*     description="Add user",
*     tags={"person"},
*     @OA\RequestBody(description="Basic note info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="Omer",	description="Name of person"),
*    				@OA\Property(property="surname", type="string", example="Bastug",	description="Surname of person" ),
*           @OA\Property(property="email", type="string", example="omerbastug@email.com",	description="Email" ),
*           @OA\Property(property="password", type="string", example="omer123",	description="Password" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Person that has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
Flight::route('POST /login', function(){
    $login = Flight::request()->data->getData();
    $user = Flight::persondao()->IsAperson($login['email']);
    if (isset($user[0]['id'])){
      if($user[0]['password'] == $login['password']){
        unset($user[0]['password']);
        $jwt = JWT::encode($user[0], Config::JWT_SECRET(), 'HS256');
        if($user[0]['role_id']==5){
          Flight::json(['token' => $jwt,'admin' => true]);
        } else {
          Flight::json(['token' => $jwt, 'admin' => false]);
        }
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