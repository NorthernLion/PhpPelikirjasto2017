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

    $routes->get('/login', function() {
        HelloWorldController::login();
    });
    
    $routes->get('/index', function() {
        HelloWorldController::index();
    });
    

//Peli
$routes->post('/game/new', function() {
    HelloWorldController::game_create();
});

$routes->get('/game', function() {
    HelloWorldController::game_list();
});

$routes->get('/game/:id', function() {
    HelloWorldController::game_show();
});

$routes->get('/game/:id/edit', function() {
    HelloWorldController::game_modify();
});

//Käyttäjä
$routes->post('/user/new', function() {
    HelloWorldController::player_create();
});

$routes->get('/user/:id', function() {
    HelloWorldController::player_show();
});

//Strategia
$routes->post('/strategy/new', function() {
    HelloWorldController::strategy_create();
});

$routes->get('/strategy', function() {
    HelloWorldController::strategy_list();
});

$routes->get('/strategy/:id', function() {
    HelloWorldController::strategy_show();
});

$routes->get('/strategy/:id/edit', function() {
    HelloWorldController::strategy_modify();
});

//Klubi
$routes->post('/club/new', function() {
    HelloWorldController::club_create();
});

$routes->get('/club', function() {
    HelloWorldController::club_list();
});

$routes->get('/club/:id', function() {
    HelloWorldController::club_show();
});




