<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * validation rules for user entities
	 *
	 */
	public static $rules = array(
		'username' => 'required|alpha_num|min:3|unique:users',
		'password' => 'required|alpha_num|between:6,20',
		'email' => 'required|email|unique:users'
	);

	/**
	 * validation error messages
	 *
	 */
	public static $messages = array(
		'username.required' => 'Korisničko ime je obavezno.',
		'username.alpha_num' => 'Korisničko ime može sadržavati samo slova i brojeve.',
		'username.min' => 'Duljina korisničkog imena je minimalno 3 znaka.',
		'username.unique' => 'Korisničko ime se već koristi.',
		'password.required' => 'Lozinka je obavezna.',
		'password.between' => 'Lozinka mora biti duljine između 6 i 20 znakova.',
		'email.required' => 'E-mail adresa je obavezna.',
		'email.email' => 'E-mail adresa nije važeća.',
		'email.unique' => 'E-mail adresa se već koristi.'
	);

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


}
