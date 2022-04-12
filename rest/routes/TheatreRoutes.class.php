<?php
require_once '../services/TheatreService.class.php';
Flight::register('theatredao', 'TheatreService');

// Prints person Table
Flight::route('GET /get/theatre', function(){
    Flight::json(Flight::theatredao()->getAllFromTable());
});
Flight::route('GET /theatre/@id', function($id){
    Flight::json(Flight::theatredao()->getByID($id));
  });
// Adds Person to person table
Flight::route('POST /add/theatre', function(){
    Flight::json(Flight::theatredao()->add(Flight::request()->data->getData()));
});

// Updates person
Flight::route('PUT /update/theatre/@id', function($id){
    Flight::theatredao()->update($id, Flight::request()->data->getData());
});

// Deletes person by id
Flight::route('PUT /delete/theatre/@id', function($id){
    Flight::theatredao()->deleteByID($id);
});

?>