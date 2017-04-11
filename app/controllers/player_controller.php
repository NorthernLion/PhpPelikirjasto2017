<?php

class PlayerController extends BaseController{

    public static function player_create(){
        View::make('player/player_create.html');
    }

    public static function player_show($id){        
        self::check_logged_in();
        $player = Player::find($id);

        View::make('player/player_show.html', array('attributes' => $player));
    }

    public static function store(){
        $params = $_POST;

        $player = new Player(array(
            'id' => $params['id'],
            'username' => $params['username'],
            'password' => $params['password'],
        ));

        $player->save();

        Redirect::to('/player/' . $player->id, array('message' => 'Käyttäjä luotu'));
    }

    public static function login(){
        View::make('player/login.html');
    }

    public static function handle_login(){
        $params = $_POST;

        $player = Player::authenticate($params['username'], $params['password']);

        if(!$player){
            View::make('player/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        }else{
            $_SESSION['player'] = $player->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $player->username . '!'));
        }
    }
    public static function logout(){        
        self::check_logged_in();
        $_SESSION['player'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }
}