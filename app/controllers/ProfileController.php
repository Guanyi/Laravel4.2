<?php

class ProfileController extends \BaseController {


    public function showProfile()
    {
        $user = Session::get('user');
        return View::make('profile')->with('user', $user);
    }

    public function saveData()
    {
        $user = Session::get('user');

        $user->notes = Input::get('notes');;
        $user->tbd = Input::get('tbd');
        $user->hyperlink1=Input::get('hyperlink1');
        $user->hyperlink2=Input::get('hyperlink2');
        $user->hyperlink3=Input::get('hyperlink3');
        $user->hyperlink4=Input::get('hyperlink4');
        $user->hyperlink5=Input::get('hyperlink5');
        $user->hyperlink6=Input::get('hyperlink6');
        $user->hyperlink7=Input::get('hyperlink7');
        $user->hyperlink8=Input::get('hyperlink8');
        $user->save();

        return Redirect::to('profile');
    }
}
