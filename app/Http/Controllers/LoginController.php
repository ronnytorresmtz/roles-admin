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
			return response()->json('The user is authorize to access the application', 200);
		}
		return response()->json('The username and password are not correct', 401);
	}


	public function getLogOut(){
		// check if the user is loggeded 
		if (Auth::check()){
				Event::fire(new RegisterTransactionAccessEvent('login.login.logout'));
				Auth::logout();
		}
		return redirect()->route('/');
	}


	public function postSendYourPassword(Request $request){	
		//Mail::pretend(true);
		$result=[];
		// send a email to the user with a token 
		$result = $this->userRepository->sendTokenToUserViaMail($request);

		if (! $result['error']){

			if (Auth::check()){
				Event::fire(new RegisterTransactionAccessEvent('login.login.sendYourPassword'));
			}

			return response()->json($result['message'], 200);

		}

		// return back with input data
		return response()->json($result['message'], 400);
	}



	// public function getPasswordReset($token){

	// 	return View::make('login.reset_your_password')->with('token', $token);

	// }


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