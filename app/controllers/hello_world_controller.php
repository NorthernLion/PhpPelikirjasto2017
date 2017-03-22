<?php

  class HelloWorldController extends BaseController{

        public static function index(){
          // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
          echo 'Tämä on etusivu!';
        }

      public static function sandbox(){
          // Testaa koodiasi täällä
          View::make('helloworld.html');
      }

      public static function lista(){
          View::make('game_list.html');
      }

      // Omat !

      public static function club_create(){
          View::make('club_create.html');
      }

      public static function club_list(){
          View::make('club_list');
      }

      public static function club_show(){
          View::make('club_show');
      }

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

      public static function player_create(){
          View::make('game_list.html');
      }

      public static function player_show(){
          View::make('helloworld.html');
      }
  }
