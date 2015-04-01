<?php

class ProfileController extends \BaseController {


    public function showProfile()
    {
        if (Session::has('expiretime')) {
            if (Session::get('expiretime') < time()) {
                Auth::logout();
                Session::flush();
                return View::make('login')->with('errorMessage', 'Your session has expired. Please login again.');
            } else {
                Session::put('expiretime', time() + 1200);
                $user = Session::get('user');
                return View::make('profile')->with('user', $user);
            }
        }
        else
            return View::make('register');
    }

    public function saveData()
    {
        if (Session::has('expiretime')) {
            if (Session::get('expiretime') < time()) {
                Auth::logout();
                Session::flush();
                return View::make('login')->with('errorMessage', 'Your session has expired. Please login again.');
            }
            else {
                Session::put('expiretime', time() + 1200);

                $user = Session::get('user');
                $user->notes = Input::get('notes');;
                $user->tbd = Input::get('tbd');
                $user->hyperlink1 = Input::get('hyperlink1');
                $user->hyperlink2 = Input::get('hyperlink2');
                $user->hyperlink3 = Input::get('hyperlink3');
                $user->hyperlink4 = Input::get('hyperlink4');
                $user->hyperlink5 = Input::get('hyperlink5');
                $user->hyperlink6 = Input::get('hyperlink6');
                $user->hyperlink7 = Input::get('hyperlink7');
                $user->hyperlink8 = Input::get('hyperlink8');
                $user->save();
                return Redirect::to('profile');
            }
        }
        else
            return View::make('register');
    }
}
