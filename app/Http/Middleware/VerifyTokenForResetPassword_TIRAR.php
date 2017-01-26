<?php namespace App\Http\Middleware;

use Closure, User, Session, Lang, Redirect;

class VerifyTokenForResetPassword {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */

	public function __construct(User $user){

		$this->user=$user;
	}


	public function handle($request, Closure $next)
	{
		$user= $this->user->where('remember_token','=', $request->token)->first();
		//verity if the token number does not exsit in the database to display a message error
		if (!isset($user)){
			//return to login displaying an error to the user because the token does not exist in the database
			return redirect()->route('login')->with('error', Lang::get('messages.error_token_noexist'));
		}	

		return $next($request);
	}

}
