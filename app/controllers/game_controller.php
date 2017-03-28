<?php

class GameController extends BaseController{

    public static function game_create(){
        View::make('game_create.html');
      }

    public static function store(){
        $params = $_POST;

        $game = new Game(array(
            'name' => $params['name'],
            'published' => $params['published'],
            'publisher' => $params['publisher'],
            'description' => $params['description']
        ));
          
        $game->save();

        Redirect::to('/game/' . $game->id, array('message' => 'Peli on lisätty sivustolle'));
    }

    public static function game_list(){
        $games = Game::all();

        View::make('game_list.html', array('games' => $games));
    }

    public static function game_modify($id){
        $game = Game::find($id);

        View::make('game_modify.html');
    }

    public static function game_show($id){
        $game = Game::find($id);
        $strategies = Strategy::findBy($id);

        View::make('game_show.html', array('game' => $game), array('strategies' => $strategies));
    }
}