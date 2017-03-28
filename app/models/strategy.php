<?php

class Strategy extends BaseModel{

    public $id, $player_id, $strategy_id, $name, $description, $published;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }

    public static function all(){

        $query = DB::connection()->prepare('SELECT * FROM Strategy');

        $query->execute();

        $rows = $query->fetchAll();
        $strategies = array();

        foreach ($rows as $row) {

            $strategies[] = new Strategy(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'published' => $row['published'],
                'publisher' => $row['publisher'],
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
                'name' => $row['name'],
                'published' => $row['published'],
                'publisher' => $row['publisher'],
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