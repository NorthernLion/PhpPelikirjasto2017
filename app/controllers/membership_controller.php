<?php

class MembershipController extends BaseController{
    public static function store(){
        self::check_logged_in();
        $params = $_POST;

        $membership = new Membership(array(
            'player_id' => $params['player_id'],
            'club_id' => $params['club_id']
        ));

        $membership = new Membership($membership);
        $membership->save();

        Redirect::to('/club', array('message' => 'Sinut on lisätty klubiin'));

    }
}