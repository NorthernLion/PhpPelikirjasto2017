<?php

class ClubController extends BaseController{

    public static function club_list(){
        $clubs = Club::all();

        View::make('club_list.html', array('clubs' => $clubs));
    }

    public static function club_show($id){
        $club = Club::find($id);

        View::make('club_show.html', array('attributes' => $club));
    }

}