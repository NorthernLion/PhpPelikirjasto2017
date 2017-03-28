<?php

  class HelloWorldController extends BaseController{

        public static function index(){
          // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
          View::make('home.html');
        }

      public static function sandbox(){
          // Testaa koodiasi täällä
          View::make('helloworld.html');
              Kint::dump($games);
      }

      public static function lista(){
          View::make('game_list.html');
      }

      // Omat !
      public static function login(){
          View::make('login.html');
      }      
      

      //Klubi

      public static function club_create(){
          View::make('club_create.html');
      }

      public static function club_list(){
          View::make('club_list.html');
      }

      public static function club_show(){
          View::make('club_show.html');
      }

      //Peli

      public static function game_create(){
          View::make('game_create.html');
      }

      public static function game_list(){
          View::make('game_list.html');
      }

      public static function game_modify(){
          View::make('game_modify.html');
      }

      public static function game_show(){
          View::make('game_show.html');
      }

      //Käyttäjä

      public static function player_create(){
          View::make('player_create.html');
      }

      public static function player_show(){
          View::make('player_show.html');
      }

      //Strategia

      public static function strategy_list(){
          View::make('strategy_list.html');
      }

      public static function strategy_modify(){
          View::make('strategy_modify.html');
      }

      public static function strategy_show(){
          View::make('strategy_show.html');
      }

      public static function strategy_create(){
          View::make('strategy_create.html');
      }
  }
