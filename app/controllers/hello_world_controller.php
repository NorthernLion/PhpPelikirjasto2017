<?php

  class HelloWorldController extends BaseController{

        public static function index(){
          // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
          View::make('home.html');
        }

      public static function sandbox(){
          // Testaa koodiasi täällä
          View::make('helloworld.html');
      }

      public static function lista(){
          View::make('game_list.html');
      }

      // Omat !
      public static function login(){
          View::make('login.html');
      }      
      

// Controllerit siirretty omiin tiedostoihinsa!
  }
