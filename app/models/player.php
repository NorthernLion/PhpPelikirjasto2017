<?php

class Player extends BaseModel{

    public $id, $name, $password, $admin;

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
                'name' => $row['name'],
                'password' => $row['password'],
                'admin' => $row['admin']
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
                'name' => $row['name'],
                'password' => $row['password'],
                'admin' => $row['admin']
            ));

            return $player;
        }

        return null;
    }


    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Player(name, password, admin)) 
        VALUES (:name, :password, :admin) RETURNING id');

        $query->execute(array('name' => $this->name, 'password' => $this->password, 'admin' => $this->admin));

        $row = $query->fetch();

        $this->id = $row['id'];
    }

}
