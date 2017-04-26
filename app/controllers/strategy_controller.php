<?php

class StrategyController extends BaseController {

    //Renderöi listaus sivun
    public static function strategy_list() {
        $strategies = Strategy::all();

        View::make('strategy/strategy_list.html', array('strategies' => $strategies), compact('strategies'));
    }

    //Renderöi muokkaus sivun
    public static function strategy_modify($id) {
        self::check_logged_in();
        View::make('strategy/strategy_modify.html');
    }

    //Renderöi strategian näyttösivun
    public static function strategy_show($id) {
        $strategy = Strategy::find($id);
        //Etsii kaikki strategiaan liittyvät viestit
        $comments = Strategy::findAllMessages($id);

        View::make('strategy/strategy_show.html', array('strategy' => $strategy, 'comments' => $comments));
    }

    //Renderöi strategian luonti sivun
    public static function strategy_create() {
        self::check_logged_in();
        $games = Game::all();
        View::make('strategy/strategy_create.html', array('games' => $games));
    }

    //Tallentaa uuden strategian
    public static function store() {
        self::check_logged_in();
        $params = $_POST;

        $strategy = new Strategy(array(
            'player_id' => $params['player_id'],
            'game_id' => $params['game_id'],
            'name' => $params['name'],
            'description' => $params['description']
        ));

        $strategy = new Strategy($strategy);
        $errors = $strategy->errors();

        //Jos ei virheitä tallentaa, muuten ei
        if (count($errors) == 0) {

            $strategy->save();
            Redirect::to('/strategy/' . $strategy->id, array('message' => 'Strategia on lisätty sivustolle'));
        } else {
            $games = Game::all();
            View::make('strategy/strategy_create.html', array('games' => $games, 'errors' => $errors, 'strategy' => $strategy));
        }
    }

    //Renderöi muokkaus sivun
    public static function edit($id) {
        self::check_logged_in();
        $strategy = Strategy::Find($id);
        if (!self::same_as_logged_in($strategy->offsetGet('player_id')) && !self::is_admin()) {
            Redirect::to('/strategy/' . $strategy->offsetGet('id'), array('message' => 'Et voi editoida muiden Strategioita!'));
        } else {
            View::make('strategy/strategy_modify.html', array('strategy' => $strategy));
        }
    }

//Tallentaa muokatun strategian
    public static function update($id) {
        self::check_logged_in();
        $strategy = Strategy::Find($id);
        if (!self::same_as_logged_in($strategy->offsetGet('player_id')) && !self::is_admin()) {
            Redirect::to('/strategy/' . $strategy->offsetGet('id'), array('message' => 'Et voi editoida muiden Strategioita!'));
        } else {
            $params = $_POST;

            $attributes = new Strategy(array(
                'id' => $id,
                'player_id' => $params['player_id'],
                'game_id' => $params['game_id'],
                'name' => $params['name'],
                'description' => $params['description']
            ));

            $strategy = new Strategy($attributes);
            $errors = $strategy->errors();
//Jos ei virheitä
            if (count($errors) > 0) {
                View::make('strategy/strategy_modify.html', array('errors' => $errors, 'strategy' => $strategy));
            } else {
                $strategy->update();

                Redirect::to('/strategy/' . $strategy->id, array('message' => 'Strategiaa on muokattu onnistuneesti!'));
            }
        }
    }

//Tuhoaa Strategian
    public static function destroy($id) {
        self::check_logged_in();
        $strategy = Strategy::Find($id);
        if (!self::same_as_logged_in($strategy->offsetGet('player_id')) && !self::is_admin()) {
            Redirect::to('/strategy/' . $strategy->offsetGet('id'), array('message' => 'Et voi poistaa muiden Strategioita!'));
        } else {
            Strategy::delete($id);
            Redirect::to('/strategy', array('message' => 'Strategia on poistettu onnistuneesti!'));
        }
    }

}
