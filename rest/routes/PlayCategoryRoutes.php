<?php
require_once __DIR__.'\..\services\PlayCategoryService.php';
Flight::register('playcategorydao', 'PlayCategoryService');

/**
 * @OA\Get(path="/get/playcategory", tags={"play categories"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all play categories from the API. ",
 *         @OA\Response( response=200, description="List of play categories.")
 * )
 */

Flight::route('GET /get/playcategory', function(){
    Flight::json(Flight::playcategorydao()->getAllFromTable());
});

/**
 * @OA\Get(path="/get/playcategory/{id}", tags={"play categories"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Id of category"),
 *         summary="Return category with the ID from the API. ",
 *         @OA\Response( response=200, description="Person's ID")
 * )
 */
Flight::route('GET /get/playcategory/@id', function($id){
    Flight::json(Flight::playcategorydao()->getByID($id));
  });
