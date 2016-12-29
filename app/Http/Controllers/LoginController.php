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

    	return View::make ('login.logIn');
    }

   
	public function postLogIn(Request $request){

		//Verify if the user has access to the application
		if ($this->loginService->verifyUserLogin($request)){

			Event::fire(new RegisterTransactionAccessEvent('login.login.login'));

			return View::make ('home.home');
		}

		return redirect()->back()->withInput();
	}


	public function getLogOut(){

		// check if the user is loggeded 
		if (Auth::check()){

				Event::fire(new RegisterTransactionAccessEvent('login.login.logout'));

				Auth::logout();
		}

		return View::make ('login.logIn');
	}


	public function getForgotYourPassword(){

		Session::forget('message');

		return View::make ('login.forgot_your_password');
	}


	//public function postSendYourPassword(ForgotPasswordRequest $request){	
	public function postSendYourPassword(Request $request){	
		//Mail::pretend(true)

		//validate the fields base on the rules define in the model, messages define in the Languages Files (Lang Directory)
		$validator=$this->validationService->validateInputs($this->userRepository, $request->all(), 'SendPasswordForm','validation.login');
		
		if ($validator->fails()) {
		
			// return back with input data and error messages
			return redirect()->route('login.forgotYourPassword')->withInput()->withErrors($validator);
		}

		// send a email to the user with a token 
		if ($this->userRepository->sendTokenToUserViaMail($request->all())){

			Event::fire(new RegisterTransactionAccessEvent('login.login.sendYourPassword'));

			return View::make('login.forgot_your_password');

		}

		// return back with input data
		return redirect()->route('login.forgotYourPassword')->withInput();
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