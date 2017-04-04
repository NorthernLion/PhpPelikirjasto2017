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

        $game = new Game($game);
        $errors = $game->errors();

        if(count($errors) == 0){

            $game->save();

            Redirect::to('/game/' . $game->id, array('message' => 'Peli on lisätty kirjastoosi!'));
        }else{

            View::make('game/new.html', array('errors' => $errors, 'attributes' => $game));
        }
    }

    public static function game_list(){
        $games = Game::all();

        View::make('game_list.html', array('games' => $games));
    }

    public static function game_modify($id){
        $game = Game::find($id);
        View::make('game/edit.html', array('attributes' => $game));
    }

    public static function game_show($id){
        $game = Game::find($id);
        $strategies = Strategy::findBy($id);

        View::make('game_show.html', array('game' => $game), array('strategies' => $strategies));
    }


    public static function update($id){
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
      'publisher' => $params['publisher'],
      'published' => $params['published'],
      'description' => $params['description']
    );

    $game = new Game($attributes);
    $errors = $game->errors();

    if(count($errors) > 0){
        View::make('game/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
        $game->update();

        Redirect::to('/game/' . $game->id, array('message' => 'Peliä on muokattu onnistuneesti!'));
    }
  }


    public static function destroy($id){

        $game = new Game(array('id' => $id));

        $game->destroy();

        Redirect::to('/game', array('message' => 'Peli on poistettu onnistuneesti!'));
    }

}