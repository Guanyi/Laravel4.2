<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    protected $fillable = [
        'id',
        'active',
        'notes',
        'tbd',
        'hyperlink1',
        'hyperlink2',
        'hyperlink3',
        'hyperlink4',
        'hyperlink5',
        'hyperlink6',
        'hyperlink7',
        'hyperlink8',
        'image1',
        'image2',
        'image3',
        'image4'
    ];

    public static $rules = [
        'id' => 'required|email', // make sure the email is an actual email
        'password' => 'required'  // password can only be alphanumeric and has to be greater than 3 characters;
    ];

    public $messages;

    public function isActive() {
        if($this->active == true)
            return true;
        else
            return false;
    }

    public function isInputValid($inputs) {
        $validator = Validator::make($inputs, static::$rules);

        if ($validator->fails()) {
            $this->messages = $validator->messages();
            return false;
        }

        return true;
    }
}
