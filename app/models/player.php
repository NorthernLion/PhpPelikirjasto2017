<?php

class Player extends BaseModel{

    public $id, $username, $password;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }
    
    public function players() {
        return $this->hasMany('Strategy');
    }
    

    public static function all(){

        $query = DB::connection()->prepare('SELECT * FROM Player');

        $query->execute();

        $rows = $query->fetchAll();
        $players = array();

        foreach ($rows as $row) {

            $players[] = new Player(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
            ));
        }

        return $players;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row) {
            $player = new Player(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
            ));

            return $player;
        }

        return null;
    }
    
    public static function findStrategiesBy($player_id){
        $query = DB::connection()->prepare('SELECT Strategy.name, Strategy.id, Game.id AS '
                . 'game_id, Game.name AS game_name FROM Strategy INNER JOIN Game '
                . 'ON Strategy.game_id = Game.id WHERE Strategy.player_id = :player_id');
        $query->execute(array('player_id' => $player_id));
        $rows = $query->fetchAll();
        $array = array();

        foreach ($rows as $row) {

            $array[] = new ArrayObject(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'game_id' => $row['game_id'],
                'game_name' => $row['game_name']
            ));
        }

        return $array;    
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Player(username, password)) 
        VALUES (:username, :password) RETURNING id');

        $query->execute(array('username' => $this->username, 'password' => $this->password));

        $row = $query->fetch();

        $this->id = $row['id'];
    }
    
    
    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        
        if ($row) {
            $player = new Player(array (
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
            return $player;
        } else {
            return null;
        }
    }
    
    public static function login(){
          View::make('login.html');
    }    

}
