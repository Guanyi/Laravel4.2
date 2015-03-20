<?php

class ProfileController extends \BaseController {


    public function showProfile()
    {
        $user = Session::get('user');
        return View::make('profile')->with('user', $user);
    }

    public function saveData()
    {
        $notes = Input::get('notes');
        $tbd = Input::get('tbd');
        $user = Session::get('user');

        $user->notes = $notes;
        $user->tbd = $tbd;
        $user->save();
        return Redirect::to('profile');
    }
}
