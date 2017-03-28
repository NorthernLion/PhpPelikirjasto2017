<?php

class StrategyController extends BaseController{
    public static function strategy_list(){
        $strategies = Strategy::all();

        View::make('strategy_list.html', array('strategies' => $strategies));
    }

    public static function strategy_modify($id){
        View::make('strategy_modify.html');
    }

    public static function strategy_show($id){
        $strategy = Strategy::find($id);

        View::make('strategy_show.html', array('attributes' => $strategy));
    }

    public static function strategy_create(){
        View::make('strategy_create.html');
    }

    public static function store(){
        $params = $_POST;

        $strategy = new Strategy(array(
            'id' => $params['id'],
            'name' => $params['name'],
            'published' => $params['published'],
            'publisher' => $params['publisher'],
            'description' => $params['description']
        ));

        $strategy->save();

        Redirect::to('/strategy/' . $strategy->id, array('message' => 'Strategia on lisätty sivustolle'));
    }
}