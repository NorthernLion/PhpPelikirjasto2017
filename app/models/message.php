<?php

class Message extends BaseModel{

    public $id, $player_id, $strategy_id, $description, $created;

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_description');
    }
    


    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Message WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row) {
            $comment = new Message(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'strategy_id' => $row['strategy_id'],
                'description' => $row['description'],
                'created' => $row['created']
            ));

            return $comment;
        }

        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Message (player_id, strategy_id, description) VALUES (:player_id, :strategy_id, :description);');

        $query->execute(array('player_id' => $this->player_id, 'strategy_id' => $this->strategy_id, 'description' => $this->description));
    }
    
    
    public function delete($id){
        $query = DB::connection()->prepare('DELETE FROM Message WHERE id = :id');
        $query->execute(array('id' => $id));        
    }
    
}

