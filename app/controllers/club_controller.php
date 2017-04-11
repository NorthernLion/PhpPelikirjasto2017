<?php

class ClubController extends BaseController{

    public static function club_list(){
        $clubs = Club::all();

        View::make('club/club_list.html', array('clubs' => $clubs));
    }

    public static function club_show($id){
        self::check_logged_in();
        $club = Club::find($id);

        View::make('club/club_show.html', array('club' => $club));
    }
}