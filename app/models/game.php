<?php

class Game extends BaseModel{

    public $id, $name, $published, $publisher, $description;

    public function __construct($attributes){
        parent::__construct($attributes);
        //Validoi nimen, julkaisupvm ja kuvauksen
        $this->validators = array('validate_name', 'validate_published', 'validate_description');
    }
    //Valitsee kaikki pelit Game taulusta
    public static function all(){

        $query = DB::connection()->prepare('SELECT * FROM Game');

        $query->execute();

        $rows = $query->fetchAll();
        $games = array();

        foreach ($rows as $row) {

            $games[] = new Game(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'published' => $row['published'],
                'publisher' => $row['publisher']
            ));
        }

        return $games;
    }
//Etsii tietyn pelin ID:llä
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Game WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row) {
            $game = new Game(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'published' => $row['published'],
                'publisher' => $row['publisher'],
                'description' => $row['description']
            ));

            return $game;
        }

        return null;
    }

    //Tallentaa annetun pelin tietokantaan
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Game (name, published, publisher, description) VALUES (:name, :published, :publisher, :description) RETURNING id');

        $query->execute(array('name' => $this->name, 'published' => $this->published, 'publisher' => $this->publisher, 'description' => $this->description));

        $row = $query->fetch();

        $this->id = $row['id'];
    }
    
    //Tuhoaa pelin tietokannasta
    public function delete($id){
        $query = DB::connection()->prepare('DELETE FROM Game WHERE id = :id');
        $query->execute(array('id' => $id));        
    }
    // päivittää pelin tiedon tietokannassa
    public function update() {
        $query = DB::connection()->prepare('UPDATE Game SET name = :name, published = :published, publisher = :publisher, description = :description WHERE id = :id');
        $query->execute(array('name' => $this->name, 'published' => $this->published, 'publisher' => $this->publisher, 'description' => $this->description, 'id' => $this->id));
        
        $row = $query->fetch();
    }
    //Etsii kaikki peliin liittyvät strategiat
    public static function findStrategybyGame($game_id){
        $query = DB::connection()->prepare('SELECT Strategy.id, Strategy.player_id, Strategy.name, Player.username AS player_name FROM Strategy INNER JOIN Player ON Player.id = Strategy.player_id WHERE Strategy.game_id = :game_id;');
        $query->execute(array(':game_id' => $game_id));
        $rows = $query->fetchAll();
        $array = array();

        foreach ($rows as $row) {

            $array[] = new ArrayObject(array(
                'name' => $row['name'],
                'player_name' => $row['player_name'],
                'player_id' => $row['player_id'],
                'id' => $row['id']
            ));
        }

        return $array;        
    }


}

