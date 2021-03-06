<?php

class MessageController extends BaseController{


    //Uuden viestin tallentaminen
    public static function store(){
        self::check_logged_in();
        $params = $_POST;

        $comment = new Message(array(
            'player_id' => $params['player_id'],
            'strategy_id' => $params['strategy_id'],
            'description' => $params['description']
        ));

        $comment = new Message($comment);
        $errors = $comment->errors();
    //Jos virheitä ei talleneta
        if(count($errors) == 0){

            $comment->save();

            Redirect::to('/strategy/' . $comment->strategy_id, array('message' => 'Viesti on lisätty!'));
        }else{

            Redirect::to('/strategy/' . $comment->strategy_id, array('errors' => $errors, 'comment' => $comment));
        }
    }


// Viestin tuohoaminen
    public static function destroy($id){
        self::check_logged_in();
        $comment = Message::find($id);
        
        if (!self::same_as_logged_in($comment->player_id) && !self::is_admin()) {
            Redirect::to('/strategy/' . $comment->strategy_id, array('message' => 'Et voi poistaa muiden viestejä'));
        } else {
            Message::delete($id);
            Redirect::to('/strategy/' . $comment->strategy_id, array('message' => 'Viesti on poistettu onnistuneesti!'));
        }

        
    }

}