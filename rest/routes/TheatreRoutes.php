<?php
require_once __DIR__.'/../services/TheatreService.class.php';
Flight::register('theatredao', 'TheatreService');
/**
 * @OA\Get(path="/get/theatre", tags={"theatre"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all theaters from the API. ",
 *         @OA\Response( response=200, description="List of theaters.")
 * )
 */
// Prints person Table
Flight::route('GET /get/theatre', function(){
    Flight::json(Flight::theatredao()->getAllFromTable());
});

/**
 * @OA\Get(path="/get/theatre/{id}", tags={"theatre"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Id of theatre"),
 *         summary="Return all theaters from the API. ",
 *         @OA\Response( response=200, description="List of theaters.")
 * )
 */
Flight::route('GET /get/theatre/@id', function($id){
    Flight::json(Flight::theatredao()->getByID($id));
  });

/**
* @OA\Post(
*     path="/add/theatre", 
*     description="Add theatre",
*     tags={"theatre"},
*     @OA\RequestBody(description="Basic theatre info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="numberofrows", type="int", example=6,	description="Number of Seat Rows"),
*    				@OA\Property(property="numberofcolumns", type="int", example=10,	description="Number of Seat Columns" ),
*                   @OA\Property(property="totalSeats", type="int", example=60,	description="Total number of Seats" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Theatre has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/ 
// Adds Person to person table
Flight::route('POST /add/theatre', function(){
    Flight::json(Flight::theatredao()->add(Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/update/theatre/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update theatre",
*     tags={"theatre"},
*     @OA\Parameter(in="path", name="id", example=1, description="Theatre ID"),
*     @OA\RequestBody(description="Basic theatre info", required=true,
*           @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="numberofrows", type="int", example=6,	description="Number of Seat Rows"),
*    				@OA\Property(property="numberofcolumns", type="int", example=10,	description="Number of Seat Columns" ),
*                   @OA\Property(property="totalSeats", type="int", example=60,	description="Total number of Seats" ),
*               )
*           )
*      ),
*     @OA\Response(
*         response=200,
*         description="Theatre that has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
// Updates person
Flight::route('PUT /update/theatre/@id', function($id){
    Flight::theatredao()->update($id, Flight::request()->data->getData());
});

/**
* @OA\DELETE(
*     path="/delete/theatre/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete theatre",
*     tags={"theatre"},
*     @OA\Parameter(in="path", name="id", example=1, description="Theatre ID"),
*     @OA\Response(
*         response=200,
*         description="Theatre that has been deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
// Deletes person by id
Flight::route('PUT /delete/theatre/@id', function($id){
    Flight::theatredao()->deleteByID($id);
});

?>