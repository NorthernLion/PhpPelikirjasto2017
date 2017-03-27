<?php

class Club extends BaseModel{

    public $id, $name, $created;

    public function __construct($attributes)
    {
    parent::__construct($attributes);
    }

    public static function all(){

        $query = DB::connection()->prepare('SELECT * FROM Club');

        $query->execute();

        $rows = $query->fetchAll();
        $clubs = array();

        foreach ($rows as $row) {

            $clubs[] = new Club(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'created' => $row['created']
            ));
        }

        return $clubs;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Club WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row) {
            $club = new Club(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'created' => $row['created'],
            ));

            return $club;
        }

        return null;
    }



}