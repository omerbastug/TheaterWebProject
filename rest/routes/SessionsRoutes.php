<?php
require_once __DIR__.'/../services/SessionsService.class.php';
Flight::register('sessionsdao', 'SessionsService');
/**
 * @OA\Get(path="/get/sessions", tags={"sessions"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all sessions from the API. ",
 *         @OA\Response( response=200, description="List of sessions.")
 * )
 */
// Prints person Table
Flight::route('GET /get/sessions', function(){
    Flight::json(Flight::sessionsdao()->getAllFromTable());
});

/**
 * @OA\Get(path="/get/sessions/{id}", tags={"sessions"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="ID of session"),
 *         summary="Return session by ID from the API. ",
 *         @OA\Response( response=200, description="session with ID")
 * )
 */
Flight::route('GET /sessions/@id', function($id){
    Flight::json(Flight::sessionsdao()->getByID($id));
  });

/**
* @OA\Post(
*     path="/add/sessions", 
*     description="Add session",
*     tags={"sessions"},
*     @OA\RequestBody(description="Basic session info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="time", type="string", example="2022-03-25 11:00:00",	description="Name of person"),
*    				@OA\Property(property="theatre_id", type="int", example=3,	description="Surname of person" ),
*                   @OA\Property(property="ticketChecker", type="int", example=6,	description="Email" ),
*                   @OA\Property(property="cleaner", type="int", example=5,	description="Password" ),
*                   @OA\Property(property="ticketsAvailable", type="int", example=60,	description="Password" ),
*                   @OA\Property(property="play_id", type="int", example=1,	description="Password" ),
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
Flight::route('POST /add/sessions', function(){
    Flight::json(Flight::sessionsdao()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/update/sessions/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update session",
*     tags={"sessions"},
*     @OA\Parameter(in="path", name="id", example=1, description="Session ID"),
*     @OA\RequestBody(description="Basic session info", required=true,
*           @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="time", type="string", example="2022-03-25 11:00:00",	description="Name of person"),
*    				@OA\Property(property="theatre_id", type="int", example=3,	description="Surname of person" ),
*                   @OA\Property(property="ticketChecker", type="int", example=6,	description="Email" ),
*                   @OA\Property(property="cleaner", type="int", example=5,	description="Password" ),
*                   @OA\Property(property="ticketsAvailable", type="int", example=60,	description="Password" ),
*                   @OA\Property(property="play_id", type="int", example=1,	description="Password" ),
*               )
*           )
*      ),
*     @OA\Response(
*         response=200,
*         description="Session that has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
// Updates person
Flight::route('PUT /update/sessions/@id', function($id){
    Flight::sessionsdao()->update($id, Flight::request()->data->getData());
});


// Deletes person by id
Flight::route('PUT /delete/sessions/@id', function($id){
    Flight::sessionsdao()->deleteByID($id);
});

?>