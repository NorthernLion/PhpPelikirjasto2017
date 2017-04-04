<?php

  class HelloWorldController extends BaseController{

        public static function index(){
          // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
          View::make('home.html');
        }

      public static function sandbox(){
              $doom = new Game(array(
                  'name' => 'd',
                  'published' => 'eilen',
                  'publisher' => 'id Software',
                  'description' => 'Boom, boom!'
              ));
              $errors = $doom->errors();

              Kint::dump($errors);

      }



      // Omat !
      public static function login(){
          View::make('login.html');
      }      
      

// Controllerit siirretty omiin tiedostoihinsa!
  }
