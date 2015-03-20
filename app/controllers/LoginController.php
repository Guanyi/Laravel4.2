<?php


class LoginController extends BaseController {

	public function showLogin()
	{
        return View::make('login');
	}

	public function processLogin()
	{
        $rules = array(
            'id' => 'required|email', // make sure the email is an actual email
            'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return Redirect::to('/')->withErrors($validator)->withInput(Input::except('password'));

        else {
            $userdata = array(
                'id' => Input::get('id'),
                'password' => Input::get('password')
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                $primaryKey = $userdata['id'];
                $user = User::find($primaryKey);
                Session::put('key', 'loggedin');
                Session::put('id', $primaryKey);
                Session::put('user', $user);

                return Redirect::to('profile');
            }
            else
                return View::make('failedlogin')->with('message', 'No match record found.');
        }
	}
}
