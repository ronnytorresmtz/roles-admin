<?php namespace Megacampus\Services\Login;

use Megacampus\Repositories\RoleTransaction\RoleTransactionRepositoryInterface;
use Megacampus\Repositories\User\UserRepositoryInterface;

use Auth, Event, Session, Lang, Log, View;


class LoginService implements LoginServiceInterface {

    protected $userRepository;
    protected $roleTransactionRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                RoleTransactionRepositoryInterface $roleTransactionRepository)
    {
        $this->userRepository            = $userRepository;
        $this->roleTransactionRepository = $roleTransactionRepository;
    }
	
	public function verifyUserLogin($request)
	{
		//get the user credenciales
		$username		=$request['username'];
		$password 		=$request['password'];
		//read if the user want to keep the session until logout action
		$remember = (isset($request['remember_me'])) ? true : false;
		// atempt to authenticate the user to login 
		if (Auth::attempt(array('username' => $request['username'] ,'password' => $request['password']), $remember)){
				//get user role id
	 			$roleId = $this->userRepository->find(Auth::user()->id)->role_id; 
	            //check if the user id has access to modules 
	             if ($this->roleTransactionRepository->roleHastAccessToAnyModule($roleId)){
					//Set a remember key for the username to be display in the login username field next time
					Session::put('remember_username', $request['usenamre']);
					// user is autheticated 
					return true;
				} 
				else {
					// force a user logout because he does not have access to any modules
					Auth::logout();
					//set the error message for the user
					Session::flash('error', Lang::get('labels.access_denied'));
					// user NO autheticated 
					return false;
				}
		}
		//set the error message for the user
		Session::flash('error', Lang::get('messages.error_login_fails'));
		// user NO autheticated
		return false;
	}
}