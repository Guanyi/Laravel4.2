<?php

class LoginController extends BaseController {

	public function showLogin($errorMessage = '')
	{
        if(isset($_COOKIE['name']))
            return View::make('login')->with('errorMessage', $errorMessage)->with('cookie', $_COOKIE['name']);
        else
            return View::make('login')->with('errorMessage', $errorMessage);
	}

    public function processLogout() {
        Auth::logout();
        Session::flush();
        return Redirect::to('login');
    }

	public function processLogin()
	{
        $user = new User;
        if ( ! $user->isInputValid(Input::all()) )
            return Redirect::to('/')->withInput(Input::except('password'))->withErrors($user->messages);
        else {
            $userdata = array(
                'id' => Input::get('id'),
                'password' => Input::get('password'),
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                $user = User::find(Input::get('id'));
                if( ! $user->isActive() ) {
                    Auth::logout();
                    Session::flush();
                    return $this->showLogin('Your account has been disabled. Please reset password and check your email.');
                }
                Session::put('key', 'loggedin');
                Session::put('user', $user);
                Session::put('expiretime', time() + 1200);
                $user->failedLoginNum = 0;
                $user->active = true;
                $user->save();
                setcookie('name', Input::get('id'), time() + (86400 * 30), "/");
                return Redirect::to('profile');
            }
            else {
                $user = User::find(Input::get('id'));
                //only password is wrong
                if($user != null) {
                    if( ! $user->isActive() ) {
                        Auth::logout();
                        Session::flush();
                        return $this->showLogin('Your account has been disabled. Please reset password and check your email.');
                    }
                    $num = ++$user->failedLoginNum;
                    if($num == 3) {
                        $user->active = false;
                        $newPassword = $this->generateRandomString();
                        $user->confirmationtoken = str_random(20);
                        $data = [ 'password' => $newPassword, 'link' => 'http://localhost:8000/' . $user->id . '+' . $user->confirmationtoken];
                        $user->password = Hash::make($newPassword);
                        Mail::send('passwordreset', $data, function($message)
                        {
                            $userEmail = Input::get('id');
                            $message->from('bcit3975@gmail.com', 'COMP3975 Assignment1');
                            $message->to($userEmail, $userEmail)->subject('Here is your new password');
                        });
                    }
                    $user->save();
                    return $this->showLogin('You have failed log in in a row ' . $num . ' times.');
                }
                else
                    return $this->showLogin('No match record found.');
            }
        }
	}

    public function sendPassword () {
        $user = User::find(Input::get('id'));
        if($user != null) {
            $newPassword = $this->generateRandomString();
            $data = [ 'password' => $newPassword, 'link' => 'http://localhost:8000/' . $user->id ];
            $user->password = Hash::make($newPassword);
            Mail::send('passwordreset', $data, function($message)
            {
                $userEmail = Input::get('id');
                $message->from('bcit3975@gmail.com', 'COMP3975 Assignment1');
                $message->to($userEmail, $userEmail)->subject('Here is your new password');
            });
            $user->save();
            return View::make('passwordsendconfirmation')->with('confirm', true);
        }
        else {
            return View::make('passwordsendconfirmation')->with('confirm', false);
        }
    }

    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}