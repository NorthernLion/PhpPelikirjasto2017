<?php

class Strategy extends BaseModel{

    public $id, $player_id, $game_id, $name, $description, $published;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }
    
    public function game() {
        return $this->belongsTo('Game', 'id');
    }
    
    public function player() {
        return $this->belongsTo('Player', 'id');
    }


    public static function all(){

        $query = DB::connection()->prepare('SELECT * FROM Strategy');

        $query->execute();

        $rows = $query->fetchAll();
        $strategies = array();

        foreach ($rows as $row) {

            $strategies[] = new Strategy(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'game_id' => $row['game_id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'published' => $row['published']
            ));
        }

        return $strategies;
    }
    
    public static function findBy($game_id){
        $query = DB::connection()->prepare('SELECT * FROM Strategy WHERE game_id = :game_id');
        $query->execute(array(':game_id' => $game_id));
        $rows = $query->fetchAll();
        $strategies = array();

        foreach ($rows as $row) {

            $strategies[] = new Strategy(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'game_id' => $row['game_id'],
                'name' => $row['name'],
                'published' => $row['published'],
                'description' => $row['description']
            ));
        }

        return $strategies;        
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Strategy WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row) {
            $strategy = new Strategy(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'game_id' => $row['game_id'],
                'name' => $row['name'],
                'published' => $row['published'],
                'description' => $row['description']
            ));

            return $strategy;
        }

        return null;
    }

    public function save(){
        //TO BE DONE pitää saada sessiosta jotenkin player id ja peli id...
    }

}