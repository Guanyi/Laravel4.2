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

}
