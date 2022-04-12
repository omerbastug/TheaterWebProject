<?php
require_once '../services/PlayService.class.php';
Flight::register('playdao', 'PlayService');

// Prints person Table
Flight::route('GET /get/play', function(){
    Flight::json(Flight::playdao()->getAllFromTable());
});
Flight::route('GET /play/@id', function($id){
    Flight::json(Flight::playdao()->getByID($id));
  });
// Adds Person to person table
Flight::route('POST /add/play', function(){
    Flight::json(Flight::playdao()->add(Flight::request()->data->getData()));
});

// Updates person
Flight::route('PUT /update/play/@id', function($id){
    Flight::playdao()->update($id, Flight::request()->data->getData());
});

// Deletes person by id
Flight::route('PUT /delete/play/@id', function($id){
    Flight::playdao()->deleteByID($id);
});

?>