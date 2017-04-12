<?php

class Strategy extends BaseModel{

    public $id, $player_id, $game_id, $name, $description;

    public function __construct($attributes){
        parent::__construct($attributes);
        //Validoi kuvauksen ja strategian nimen
        $this->validators = array('validate_description', 'validate_name');
    }
// L
    public static function all(){
        $query = DB::connection()->prepare('SELECT Strategy.id, Strategy.name, Strategy.game_id, Strategy.player_id, Player.username AS
            player_name, Game.name AS game_name FROM Strategy INNER JOIN Player ON Strategy.player_id = Player.id
            INNER JOIN Game on Strategy.game_id = Game.id;');
        $query->execute();
        $rows = $query->fetchAll();
        $array = array();

        foreach ($rows as $row) {

            $array[] = new ArrayObject(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'game_id' => $row['game_id'],
                'player_id' => $row['player_id'],
                'player_name' => $row['player_name'],
                'game_name' => $row['game_name']
            ));
        }

        return $array;    
    }
    
    public static function findAllMessages($strategy_id) {
        $query = DB::connection()->prepare('SELECT Message.created, Player.username, Message.description, Player.id as player_id, Message.id '
                . 'FROM Message INNER JOIN Player on Message.player_id = Player.id WHERE Message.strategy_id = :strategy_id;');
        $query->execute(array('strategy_id' => $strategy_id));
        $rows = $query->fetchAll();
        $array = array();

        foreach ($rows as $row) {

            $array[] = new ArrayObject(array(
                'username' => $row['username'],
                'description' => $row['description'],
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'created' => $row['created']
            ));
        }

        return $array;    
    }
        
    

    public static function find($strategy_id){
        $query = DB::connection()->prepare('SELECT Strategy.id, Strategy.description, Strategy.name, Strategy.game_id, Strategy.player_id, Player.username AS
            player_name, Game.name AS game_name FROM Strategy INNER JOIN Player ON Strategy.player_id = Player.id
            INNER JOIN Game on Strategy.game_id = Game.id WHERE Strategy.id = :strategy_id LIMIT 1;');
        $query->execute(array('strategy_id' => $strategy_id));
        $row = $query->fetch();

        if($row) {

            $strategy = new ArrayObject(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'game_id' => $row['game_id'],
                'player_id' => $row['player_id'],
                'player_name' => $row['player_name'],
                'game_name' => $row['game_name'],
                'description' => $row['description']    
            ));
            
            return $strategy;
        }
        
        return null;
    }

    public function save(){
    $query = DB::connection()->prepare('INSERT INTO Strategy (player_id, game_id, name, description) VALUES (:player_id, :game_id, :name, :description) RETURNING id');
    
    $query->execute(array('player_id' => $this->player_id, 'game_id' => $this->game_id, 'name' => $this->name, 'description' => $this->description));
    
    $row = $query->fetch();
    
    $this->id = $row['id'];
    }
    
    
    public function delete($id){
        $query = DB::connection()->prepare('DELETE FROM Message WHERE strategy_id = :id');
        $query->execute(array('id' => $id));  
        $query = DB::connection()->prepare('DELETE FROM Strategy WHERE id = :id');
        $query->execute(array('id' => $id));        
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Strategy SET player_id = :player_id, game_id = :game_id, name = :name, description = :description WHERE id = :id');
        $query->execute(array('player_id' => $this->player_id, 'game_id' => $this->game_id, 'name' => $this->name, 'description' => $this->description, 'id' => $this->id));

           $row = $query->fetch();
    }

}