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

$routes->get('/game', function() {
    HelloWorldController::game_list();
});

$routes->get('/game/1', function() {
    HelloWorldController::game_show();
});

$routes->get('/game/create', function() {
    HelloWorldController::game_create();
});

$routes->get('/game/modify/1', function() {
    HelloWorldController::game_modify();
});

//Käyttäjä

$routes->get('/user/1', function() {
    HelloWorldController::player_show();
});

$routes->get('/user/create', function() {
    HelloWorldController::player_create();
});

//Strategia

$routes->get('/strategy', function() {
    HelloWorldController::strategy_list();
});

$routes->get('/strategy/1', function() {
    HelloWorldController::strategy_show();
});

$routes->get('/strategy/create', function() {
    HelloWorldController::strategy_create();
});

$routes->get('/strategy/modify/1', function() {
    HelloWorldController::strategy_modify();
});

//Klubi

$routes->get('/club', function() {
    HelloWorldController::club_list();
});

$routes->get('/club/1', function() {
    HelloWorldController::club_show();
});

$routes->get('/club/create', function() {
    HelloWorldController::club_create();
});


