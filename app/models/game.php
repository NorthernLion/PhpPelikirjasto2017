<?php

class Game extends BaseModel{

    public $id, $name, $published, $publisher, $description;

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_published');
    }
    
    public function games() {
        return $this->hasMany('Strategy');
    }

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
                'publisher' => $row['publisher'],
                'description' => $row['description']
            ));
        }

        return $games;
    }

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

    public function save(){
    $query = DB::connection()->prepare('INSERT INTO Game (name, published, publisher, description) VALUES (:name, :published, :publisher, :description) RETURNING id');
    
    $query->execute(array('name' => $this->name, 'published' => $this->published, 'publisher' => $this->publisher, 'description' => $this->description));
    
    $row = $query->fetch();
    
    $this->id = $row['id'];
    }
    
    
    public function delete($id){
        $query = DB::connection()->prepare('DELETE FROM Game WHERE id = :id');
        $query->execute(array('id' => $id));        
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Game SET name = :name, published = :published, publisher = :publisher, description = :description WHERE id = :id');
        $query->execute(array('name' => $this->name, 'published' => $this->published, 'publisher' => $this->publisher, 'description' => $this->description, 'id' => $this->id));
        
        $row = $query->fetch();
    }



}

