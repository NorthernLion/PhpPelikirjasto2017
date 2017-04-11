<?php

class StrategyController extends BaseController{
    public static function strategy_list(){
        $strategies = Strategy::all();

        View::make('strategy/strategy_list.html', array('strategies' => $strategies), compact('strategies'));
    }

    public static function strategy_modify($id){
        self::check_logged_in();
        View::make('strategy/strategy_modify.html');
    }

    public static function strategy_show($id){
        $strategy = Strategy::find($id);

        View::make('strategy/strategy_show.html', array('strategy' => $strategy));
    }

    public static function strategy_create(){
        self::check_logged_in();
        $games = Game::all();
        View::make('strategy/strategy_create.html', array('games' => $games));
    }

    public static function store(){
        self::check_logged_in();
        $params = $_POST;

        $strategy = new Strategy(array(
            'player_id' => $params['player_id'],
            'game_id' => $params['game_id'],
            'name' => $params['name'],
            'description' => $params['description']
        ));
        
        $strategy = new Strategy($strategy);
        self::check_logged_in();
        $errors = $strategy->errors();
        
        if(count($errors) == 0) {
            
            $strategy->save();
            Redirect::to('/strategy/' . $strategy->id, array('message' => 'Strategia on lisätty sivustolle'));
    
            
        } else {
            View::make('strategy/strategy_create.html', array('errors' => $errors, 'strategy' => $strategy));
        }
        }
        
    public static function edit($id){
        self::check_logged_in();
        $strategy = Strategy::find($id);
        View::make('strategy/strategy_modify.html', array('strategy' => $strategy));
    }


public static function update($id){
    self::check_logged_in();
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

    if(count($errors) > 0){
      View::make('strategy/strategy_modify.html', array('errors' => $errors, 'strategy' => $strategy));
    }else{
       $strategy->update();

      Redirect::to('/strategy/' . $strategy->id, array('message' => 'Strategiaa on muokattu onnistuneesti!'));
    }
  }


    public static function destroy($id){
        self::check_logged_in();
        Strategy::delete($id);

        Redirect::to('/strategy', array('message' => 'Strategia on poistettu onnistuneesti!'));
    }
        
        
        
}