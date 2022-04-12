<?php
require_once '../services/SessionsService.class.php';
Flight::register('sessionsdao', 'SessionsService');

// Prints person Table
Flight::route('GET /get/sessions', function(){
    Flight::json(Flight::sessionsdao()->getAllFromTable());
});
Flight::route('GET /sessions/@id', function($id){
    Flight::json(Flight::sessionsdao()->getByID($id));
  });
// Adds Person to person table
Flight::route('POST /add/sessions', function(){
    Flight::json(Flight::sessionsdao()->add(Flight::request()->data->getData()));
});
// Updates person
Flight::route('PUT /update/sessions/@id', function($id){
    Flight::sessionsdao()->update($id, Flight::request()->data->getData());
});
// Deletes person by id
Flight::route('PUT /delete/sessions/@id', function($id){
    Flight::sessionsdao()->deleteByID($id);
});

?>