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
            $user->id = Input::get('id');
            $user->password = Hash::make(Input::get('password'));
            $user->confirmationtoken = str_random(20);
            $user->save();

            $data = ['link'=>'http://localhost:8000/'.Input::get('id') . '+' . $user->confirmationtoken];

            Mail::send('registrationconfirmation', $data, function($message)
            {
                $userEmail = Input::get('id');
                $message->from('bcit3975@gmail.com', 'COMP3975 Assignment1');
                $message->to($userEmail, $userEmail)->subject('PLease complete your registration');
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

        //account first activation situation
        $id = substr($any, 0, $delimPos);
        $token = substr($any, $delimPos+1);
        $user = User::find($id);
        if ($user == null) {
            return View::make('register');
        }
        if ($user->confirmationtoken != $token) {
            return View::make('register');
        }
        if($user != null && $user->confirmationtoken == $token) {
            $user->active = 1;
            $user->save();
            return Redirect::to('login');
        }
    }
}
