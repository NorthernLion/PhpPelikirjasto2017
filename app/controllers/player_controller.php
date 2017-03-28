<?php

class PlayerController extends BaseController{

    public static function player_create(){
        View::make('player_create.html');
    }

    public static function player_show($id){
        $player = Player::find($id);

        View::make('player_show.html', array('attributes' => $player));
    }

    public static function store(){
        $params = $_POST;

        $player = new Player(array(
            'id' => $params['id'],
            'name' => $params['name'],
            'password' => $params['password'],
            'admin' => $params['admin']
        ));

        $player->save();

        Redirect::to('/player/' . $player->id, array('message' => 'Käyttäjä luotu'));
    }
}