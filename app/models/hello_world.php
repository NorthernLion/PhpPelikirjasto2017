<?php

  class HelloWorld extends BaseModel{

    public static function say_hi(){
      return 'Hello World!';
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
  }
