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
                'password' => Input::get('password'),
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                $primaryKey = $userdata['id'];
                $user = User::find($primaryKey);

                if($user->active == false) {
                    Auth::logout();
                    return View::make('login')->with('errorMessage', 'Your account has been disabled. Please reset password and check your email.');
                }
                Session::put('key', 'loggedin');
                Session::put('id', $primaryKey);
                Session::put('user', $user);
                $user->failedLoginNum = 0;
                $user->save();

                return Redirect::to('profile');
            }
            else {
                $user = User::find(Input::get('id'));
                //only password is wrong
                if($user != null) {
                    $num = ++$user->failedLoginNum;
                    if($num == 3) {
                        $user->active = false;
                    }
                    $user->save();
                    return View::make('login')->with('errorMessage', 'You have failed log in in a row ' . $num . ' times.');
                }
                else
                    return View::make('login')->with('errorMessage', 'No match record found.');
            }
        }
	}
}