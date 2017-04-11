<?php

class Membership extends BaseModel{

    public $id, $player_id, $club_id;

    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Membership (player_id, club_id) VALUES (:player_id, :club_id)');

        $query->execute(array('player_id' => $this->player_id, 'club' => $this->club_id));
    }
}