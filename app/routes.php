<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'LoginController@showLogin');

Route::get('login', array('before' => 'guest', 'uses' =>'LoginController@showLogin'));

Route::post('login', 'LoginController@processLogin');

Route::post('logout', function() {
    Auth::logout();
    return Redirect::to('login');
});

Route::get('forgotpassword', function() {
    return View::make('forgotpassword');
});

Route::post('emailpasswordrequest', 'LoginController@sendPassword');

Route::get('register', 'RegistrationController@showRegistration');

Route::post('processingregistration', 'RegistrationController@processRegistration');

Route::get('profile', array('before' => 'auth', 'uses' => 'ProfileController@showProfile'));

Route::post('profile', 'ProfileController@saveData');

Route::get('/{any}', 'RegistrationController@registrationActivation');
