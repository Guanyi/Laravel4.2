<?php

use Gregwar\Captcha\CaptchaBuilder;

class RegistrationController extends \BaseController {

    public function showRegistration($errorMessage = '')
    {
        $builder = new CaptchaBuilder;
        $builder->build();
        Session::put('code', $builder->getPhrase());
        return View::make('register')->with('builder', $builder)->with('errorMessage', $errorMessage);
    }

    public function processRegistration()
    {
        if ( Session::get('code') != Input::get('code') )
            return $this->showRegistration('The CAPTCHA code you entered is wrong. Try again.');

        $rules = array(
            'id' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return Redirect::to('register')->withErrors($validator)->withInput(Input::except('password'));
        else {
            if(User::find(Input::get('id')) != null )
                return $this->showRegistration('This email has been used. Please choose another one.');
            $user = new User;
            $user->id = Input::get('id');
            $user->password = Hash::make(Input::get('password'));
            $user->confirmationtoken = str_random(20);
            $user->save();

            $data = ['link'=>'http://localhost:8000/'.Input::get('id') . '+' . $user->confirmationtoken];

            Mail::send('registrationconfirmation', $data, function($message)
            {
                $userEmail = Input::get('id');
                $message->from('bcit3975@gmail.com', 'COMP3975 Assignment1');
                $message->to($userEmail, $userEmail)->subject('Please complete your registration');
            });

            return Redirect::to('/')->with('message', 'Thanks for registering!');
        }
    }

    public function registrationActivation($any) {
        $delimPos = strpos($any, "+");

        //reset password situation
        if ($delimPos == false && $user = User::find($any)) {
            return View::make('login')->with('userId', $any);;
        }

        //account activation situation
        $id = substr($any, 0, $delimPos);
        $token = substr($any, $delimPos+1);
        $user = User::find($id);
        if ($user == null) {
            return $this->showRegistration('');
        }
        if ($user->confirmationtoken != $token) {
            return $this->showRegistration('');
        }
        if($user != null && $user->confirmationtoken == $token) {
            $user->active = 1;
            $user->save();
            return Redirect::to('login');
        }
    }
}
