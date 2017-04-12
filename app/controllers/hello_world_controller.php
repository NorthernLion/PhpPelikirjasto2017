<?php

  class HelloWorldController extends BaseController{
    // Indeksin lataus controlleri ja sen ainoa funktio index, joka renderöi index sivun
        public static function index(){
          View::make('home.html');
        }
  }
