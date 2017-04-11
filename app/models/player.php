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
