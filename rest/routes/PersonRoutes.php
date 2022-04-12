<?php
require_once '../services/PersonService.class.php';
Flight::register('persondao', 'PersonService');

// Prints person Table
Flight::route('GET /get/person', function(){
    Flight::json(Flight::persondao()->getAllFromTable());
});

Flight::route('GET /person/@id', function($id){
    Flight::json(Flight::persondao()->getByID($id));
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

?>