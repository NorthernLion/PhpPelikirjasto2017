<?php






//Index

$routes->get('/', function() {
    HelloWorldController::index();
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
    GameController::edit($id);
});

$routes->post('/game_modify/:id', function($id){
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

$routes->get('/login', function(){
    PlayerController::login();
});

$routes->post('/login', function(){
    PlayerController::handle_login();
});

$routes->post('/logout', function(){
    PlayerController::logout();
});


//Strategia


$routes->post('/strategy_create', function(){
  StrategyController::store();
});

$routes->get('/strategy/new', function() {
    StrategyController::strategy_create();
});

$routes->get('/strategy', function() {
    StrategyController::strategy_list();
});

$routes->get('/strategy/:id', function($id) {
    StrategyController::strategy_show($id);
});

$routes->get('/strategy/:id/edit', function($id) {
    StrategyController::edit($id);
});

$routes->post('/strategy_modify/:id', function($id){
    StrategyController::update($id);
});


$routes->post('/strategy/:id/destroy', function($id){
    StrategyController::destroy($id);
});


//Klubi


$routes->get('/club', function() {
    ClubController::club_list();
});

$routes->get('/club/:id', function($id) {
    ClubController::club_show($id);
});


//Jäsenyys

$routes->post('/ms_create', function(){
    MembershipController::store();
});

