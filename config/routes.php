<?php

      $routes->get('/', function() {
        HelloWorldController::index();
      });

      $routes->get('/hiekkalaatikko', function() {
        HelloWorldController::sandbox();
      });

        $routes->get('/pelitvanha', function() {
        HelloWorldController::lista();
      });

// Omat !

$routes->get('/login', function(){
    PlayerController::login();
});
$routes->post('/login', function(){
    PlayerController::handle_login();
});
    
    $routes->get('/index', function() {
        HelloWorldController::index();
    });
    

//Peli
    
$routes->post('/game_create', function(){
  GameController::store();
});

$routes->get('/game/new', function() {
    GameController::game_create();
});

$routes->get('/game', function() {
    GameController::game_list();
});

$routes->get('/game/:id', function($id) {
    GameController::game_show($id);
});

$routes->get('/game/:id/edit', function($id) {
    GameController::game_modify($id);
});

$routes->post('/game/:id/edit', function($id){
    GameController::update($id);
});

$routes->post('/game/:id/destroy', function($id){
    GameController::destroy($id);
});

//Käyttäjä
$routes->post('/user_create', function(){
  PlayerController::store();
});

$routes->get('/user/new', function() {
    PlayerController::player_create();
});

$routes->get('/user/:id', function($id) {
    PlayerController::player_show($id);
});

//Strategia

$routes->post('/strategy_create', function(){
  StrategyController::store();
});

$routes->post('/strategy/new', function() {
    StrategyController::strategy_create();
});

$routes->get('/strategy', function() {
    StrategyController::strategy_list();
});

$routes->get('/strategy/:id', function($id) {
    StrategyController::strategy_show($id);
});

$routes->get('/strategy/:id/edit', function() {
    StrategyController::strategy_modify();
});

//Klubi


$routes->get('/club', function() {
    ClubController::club_list();
});

$routes->get('/club/:id', function($id) {
    ClubController::club_show($id);
});




