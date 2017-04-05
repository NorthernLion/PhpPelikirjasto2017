<?php

class StrategyController extends BaseController{
    public static function strategy_list(){
        $strategies = Strategy::all();

        View::make('strategy_list.html', array('strategies' => $strategies), compact('strategies'));
    }

    public static function strategy_modify($id){
        View::make('strategy_modify.html');
    }

    public static function strategy_show($id){
        $strategy = Strategy::find($id);

        View::make('strategy_show.html', array('strategy' => $strategy));
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
        
        $strategy = new Strategy($strategy);
        $errors = $strategy->errors();
        
        if(count($errors) == 0) {
            
            $strategy->save();
            Redirect::to('/strategy/' . $strategy->id, array('message' => 'Strategia on lisätty sivustolle'));
    
            
        } else {
            View::make('strategy_create.html', array('errors' => $errors, 'strategy' => $strategy));
        }

        

        }
}