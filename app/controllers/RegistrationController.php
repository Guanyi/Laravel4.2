<?php

class RegistrationController extends \BaseController {

    public function showRegistration()
    {
        return View::make('register');
    }

    public function processRegistration()
    {
        $rules = array(
            'id' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return Redirect::to('register')->withErrors($validator)->withInput(Input::except('password'));

        else {
            $user = new User;
            $user->username = Input::get('id');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::to('/')->with('message', 'Thanks for registering!');
        }
    }
}
