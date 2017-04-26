<?php

class PlayerController extends BaseController {

    //Rekisteröinti sivun renderöinti
    public static function player_create() {
        View::make('player/player_create.html');
    }

    //Pelaajan sivun näyttäminen
    public static function player_show($id) {
        self::check_logged_in();
        $player = Player::find($id);
        //Etsitään kyseisen pelaajan strategiat
        $strategies = Player::findStrategiesBy($id);

        View::make('player/player_show.html', array('player' => $player, 'strategies' => $strategies));
    }

    public static function store() {
        $params = $_POST;

        $player = new Player(array(
            'username' => $params['username'],
            'password' => $params['password'],
        ));


        $player = new Player($player);
        $errors = $player->errors();

        if (count($errors) == 0) {

            $player->save();
            Redirect::to('/', array('message' => 'Käyttäjä luotu'));
        } else {
            View::make('player/player_create.html', array('errors' => $errors, 'player' => $player));
        }
    }

// Login sivun renderöinti
    public static function login() {
        View::make('player/login.html');
    }

//Kirjautumisen käsittelijä
    public static function handle_login() {
        $params = $_POST;
        //katsoo täsmäävätkö username ja salasana
        $player = Player::authenticate($params['username'], $params['password']);

        if (!$player) {
            View::make('player/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['player'] = $player->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $player->username . '!'));
        }
    }

    //Ulos kirjautumisen käsittelijä
    public static function logout() {
        self::check_logged_in();
        $_SESSION['player'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

}
