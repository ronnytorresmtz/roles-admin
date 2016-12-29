<?php 

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;


//class User extends Eloquent implements UserInterface, RemindableInterface {
class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract {

	///use Authenticatable, CanResetPassword;

	use SoftDeletes;

	
	protected $table = 'users';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_security_number', 'remember_token');

	
	//get the rules define base on a form name for validate the form inputs
	public function getInputRules($form, $request){

		\Debugbar::info($form);

		switch ($form) {

			case 'SendPasswordForm':
				$rules= array(
					'email'=> 'required|email'
				);
				break;

			case 'ResetPasswordForm':
				$rules= array(
					'remember_security_number'  => 'required',
					'new_password'              => 'required | min:6 | confirmed', //|email',
					'new_password_confirmation' => 'required | min:6 ' //|numeric'
				);
				break;


			case 'AddUserForm':
				$rules= array(
					'username'      => 'required | min:8 | unique:users',
					'user_fullname' => 'required', 
					'email'         => 'required | email | unique:users'
					
				);
				break;

			case 'UpdateUserForm':
				$rules= array(
					'username'      => 'required | min:8 | unique:users,username,' . $request['id'],
					'user_fullname' => 'required', 
					'email'         => 'required | email | unique:users,email,' . $request['id']
				);
				break;
			
		}
		
		return $rules;
	}

	//get the messages for the form validations base on the Language File
	public function getInputMessages($langFileAttributes){
		
		$messages = Lang::get($langFileAttributes);

		return $messages;
	}
	
	
	public function getAuthIdentifier(){


		return $this->getKey();
	}

	public function getAuthPassword(){

		return $this->password;
		
	}

	public function getRememberToken(){

	}


	public function setRememberToken($value){

	}


	public function getRememberTokenName(){
		
	}

	public function getEmailForPasswordReset(){

		 return $this->email;
		
	}

}


