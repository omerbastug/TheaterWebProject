<?php
require_once __DIR__.'/../services/PlayService.class.php';
Flight::register('playdao', 'PlayService');

/**
 * @OA\Get(path="/get/play", tags={"play"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all plays from the API. ",
 *         @OA\Response( response=200, description="List of plays.")
 * )
 */

Flight::route('GET /get/play', function(){
    Flight::json(Flight::playdao()->getAllFromTable());
});

Flight::route('GET /get/favoriteplays', function(){
  Flight::json(Flight::playdao()->favoritePlays(Flight::get('user')['id']));
});

Flight::route('POST /add/favoriteplay/@play_id', function($play_id){
    $user_id = Flight::get('user')['id'];
    Flight::json(Flight::playdao()->addFavorite($user_id, $play_id));
});

Flight::route('PUT /delete/favoriteplay/@id', function($id){
  Flight::playdao()->deleteFavorite(Flight::get('user')['id'],$id);
}); 


/**
 * @OA\Get(path="/get/play/{id}", tags={"play"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Id of play"),
 *         summary="Return play with the ID from the API. ",
 *         @OA\Response( response=200, description="Person's ID")
 * )
 */
Flight::route('GET /get/play/@id', function($id){
    Flight::json(Flight::playdao()->getByID($id));
  });

/**
* @OA\Post(
*     path="/add/play", 
*     description="Add play",
*     tags={"play"},
*     @OA\RequestBody(description="Basic play info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="A Midsummer Night's Dream",	description="Name of play"),
*    				@OA\Property(property="author", type="string", example="William Shakespeare",	description="Surname of play" ),
*                   @OA\Property(property="durationminutes", type="int", example=65,	description="Play duration in minutes" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Play has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

Flight::route('POST /add/play', function(){
    $entity = Flight::request()->data->getData();
    Flight::json(['sd'=>'sds']);
    if(Flight::get('user')['role_id']==5){ // Admin Check
        Flight::json(Flight::playdao()->add($entity));
      } else {
        throw new Exception("Unauthorized");
      }
});

/**
* @OA\Put(
*     path="/update/play/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update play",
*     tags={"play"},
*     @OA\Parameter(in="path", name="id", example=1, description="Play ID"),
*     @OA\RequestBody(description="Basic person info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="name", type="string", example="A Midsummer Night's Dream",	description="Name of play"),
*    				@OA\Property(property="author", type="string", example="William Shakespeare",	description="Surname of play" ),
*                   @OA\Property(property="durationminutes", type="int", example=65,	description="Play duration in minutes" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Play that has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

Flight::route('PUT /update/play/@id', function($id){
    Flight::playdao()->update($id, Flight::request()->data->getData());
});


Flight::route('PUT /delete/play/@id', function($id){
    Flight::playdao()->deleteByID($id);
});

?>