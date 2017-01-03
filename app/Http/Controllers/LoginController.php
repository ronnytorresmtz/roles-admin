<?php


use Illuminate\Http\Request;
use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Services\Login\LoginServiceInterface;
use Megacampus\Repositories\User\UserRepositoryInterface;
use Megacampus\Services\Validation\ValidationServiceInterface;

/*use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\PasswordResetRequest;*/

class LoginController extends Controller {
	/**
	* Setup the layout used by the controller.
	*
	* @return void
	*/

	protected $userRepository;
	protected $validationService;
	protected $loginService;

 	public function __construct(UserRepositoryInterface $userRepository, 
 								ValidationServiceInterface $validationService, 
 								LoginServiceInterface $loginService)
    {
      
		$this->userRepository      = $userRepository;
		$this->validationService   = $validationService;
		$this->loginService        = $loginService;
    }


    public function getLogIn(){
		return View::make ('vueroute');
    }
   

	public function postLogIn(Request $request){
		//Verify if the user has access to the application
		if ($this->loginService->verifyUserLogin($request)){
			Event::fire(new RegisterTransactionAccessEvent('login.login.login'));
			return response()->json('authorize', 200);
		}
		return response()->json('not authorize', 401);
	}


	public function getLogOut(){
		// check if the user is loggeded 
		if (Auth::check()){
				Event::fire(new RegisterTransactionAccessEvent('login.login.logout'));
				Auth::logout();
		}
		return redirect()->route('/');
	}


	// public function getForgotYourPassword(){

	// 	Session::forget('message');

	// 	return View::make ('login.forgot_your_password');
	// }


	//public function postSendYourPassword(ForgotPasswordRequest $request){	
	public function postSendYourPassword(Request $request){	
		Mail::pretend(true);

		//validate the fields base on the rules define in the model, messages define in the Languages Files (Lang Directory)
		// $validator=$this->validationService->validateInputs($this->userRepository, $request->all(), 'SendPasswordForm','validation.login');
		
		// if ($validator->fails()) {
		// 	return response()->json('The email sent is an invalid email account', 400);
		// }

		// send a email to the user with a token 
		if ($this->userRepository->sendTokenToUserViaMail($request->all())){

			//Event::fire(new RegisterTransactionAccessEvent('login.login.sendYourPassword'));

			return response()->json('The instructions to set a new password were sent', 200);

		}

		// return back with input data
		return response()->json('The application could not sent the instrucctions to set a new password, try again or call the system administrator.', 400);
	}



	public function getPasswordReset($token){

		return View::make('login.reset_your_password')->with('token', $token);

	}


	public function postResetYourPassword(Request $request){

		// validate the fields base on the rules and messages define in the Model, messages define in the Languages Files (Lang Directory)
		$validator=$this->validationService->validateInputs($this->userRepository, $request->all(), 'ResetPasswordForm','validation.login');
		
		if ($validator->fails()) {
		
			// return back with input data and error messages
			return redirect()->back()->withInput()->withErrors($validator);
		}

		// reset the password for the user
		if ($this->userRepository->resetUserPassowrd($request->all())){

			Event::fire(new RegisterTransactionAccessEvent('login.login.resetUserPassword'));

			return redirect()->route('login');

		}
		// return back with input data
		return redirect()->back()->withInput();
	}


	

}