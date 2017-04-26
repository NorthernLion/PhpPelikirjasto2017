<?php

  class BaseController{
      
    public static function get_user_logged_in(){
      if (isset($_SESSION['player'])) {
        $player_id = $_SESSION['player'];
        
        $player = Player::find($player_id);
        
        return $player;
      }
      
      return null;
    }
    
    public static function same_as_logged_in($ownerPlayer_id) {   
        $player = self::get_user_logged_in();
        $ownerPlayer = Player::find($ownerPlayer_id);
        return $player != null && $player == $ownerPlayer;
        
    }
    
    public static function is_admin() {
        $currentPlayer = self::get_user_logged_in();
        if($currentPlayer === null) {
            return false;
        }
        if($currentPlayer->owner) {
            return true;
        }
        return false;        
    }
    
    public static function check_logged_in(){
      if (!isset($_SESSION['player'])) {
        Redirect::to('/login', array('message' => 'Kirjaudu ensin sisään!'));
      }
    }
 
  }
