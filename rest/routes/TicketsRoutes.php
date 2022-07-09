<?php
require_once __DIR__.'/../services/TicketsService.class.php';
Flight::register('ticketsService', 'TicketsService');

/**
 * @OA\Get(path="/get/tickets", tags={"tickets"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all purchased tickets from the API. ",
 *         @OA\Response( response=200, description="List of tickets.")
 * )
 */
// Prints person Table
Flight::route('GET /get/tickets', function(){
    Flight::json(Flight::ticketsService()->getAllFromTable());
});

/**
 * @OA\Get(path="/get/tickets/{id}", tags={"tickets"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Id of ticket"),
 *         summary="Return purchased ticket with ID from the API. ",
 *         @OA\Response( response=200, description="ticket with ID")
 * )
 */
Flight::route('GET /get/tickets/@id', function($id){
    Flight::json(Flight::ticketsService()->getByID($id));
  });

/**
 * @OA\Get(path="/get/ticketsbysess/{id}", tags={"tickets"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Id of session"),
 *         summary="Return purchased tickets of session with ID from the API. ",
 *         @OA\Response( response=200, description="List of tickets purchased of session with ID")
 * )
 */
Flight::route('GET /get/ticketsbysess/@id', function($id){
    Flight::json(Flight::ticketsService()->getBysessID($id));
});

/**
* @OA\Post(
*     path="/add/tickets", 
*     description="Add ticket",
*     tags={"tickets"},
*     @OA\RequestBody(description="Basic ticket info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="session_id", type="int", example=2,	description="ID of the session"),
*    				@OA\Property(property="seatRow", type="int", example=3,	description="Seat Row" ),
*                   @OA\Property(property="seatColumn", type="int", example=2,	description="Seat Column" ),
*                   @OA\Property(property="personID", type="int", example=6,	description="Person id" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Ticket has been added"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/ 
// Adds Person to person table
Flight::route('POST /add/tickets', function(){
    Flight::json(Flight::ticketsService()->addticket(Flight::get('user'),Flight::request()->data->getData()));
});

/**
* @OA\Put(
*     path="/update/tickets/{id}", security={{"ApiKeyAuth": {}}},
*     description="Update ticket",
*     tags={"tickets"},
*     @OA\Parameter(in="path", name="id", example=1, description="Ticket ID"),
*     @OA\RequestBody(description="Basic theatre info", required=true,
*           @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="session_id", type="int", example=2,	description="ID of the session"),
*    				@OA\Property(property="seatRow", type="int", example=3,	description="Seat Row" ),
*                   @OA\Property(property="seatColumn", type="int", example=2,	description="Seat Column" ),
*                   @OA\Property(property="personID", type="int", example=6,	description="Person id" ),
*               )
*           )
*      ),
*     @OA\Response(
*         response=200,
*         description="Ticket that has been updated"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
// Updates person
Flight::route('PUT /update/tickets/@id', function($id){
    Flight::ticketsService()->update($id, Flight::request()->data->getData());
});

/**
* @OA\DELETE(
*     path="/delete/tickets/{id}", security={{"ApiKeyAuth": {}}},
*     description="Delete ticket",
*     tags={"tickets"},
*     @OA\Parameter(in="path", name="id", example=1, description="Ticket ID"),
*     @OA\Response(
*         response=200,
*         description="Ticket that has been deleted"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/
// Deletes person by id
Flight::route('PUT /delete/tickets/@id', function($id){
    Flight::ticketsService()->deleteByID($id);
});

?>