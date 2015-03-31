<?php


class LoginController extends BaseController {

	public function showLogin()
	{
        return View::make('login');
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
                    return View::make('login')->with('errorMessage', 'Your account has been disabled. Please reset password and check your email.');
                }
                Session::put('key', 'loggedin');
                //Session::put('id', Input::get('id'));
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
                        $newPassword = $this->generateRandomString();
                        $data = [ 'password' => $newPassword, 'link' => 'http://localhost:8000/' . $user->id ];
                        $user->password = Hash::make($newPassword);
                        Mail::send('passwordreset', $data, function($message)
                        {
                            $userEmail = Input::get('id');
                            $message->from('bcit3975@gmail.com', 'COMP3975 Assignment1');
                            $message->to($userEmail, $userEmail)->subject('Here is your new password');
                        });
                    }
                    $user->save();
                    return View::make('login')->with('errorMessage', 'You have failed log in in a row ' . $num . ' times.');
                }
                else
                    return View::make('login')->with('errorMessage', 'No match record found.');
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
        }
        $user->save();
        return View::make('passwordsendconfirmation');
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