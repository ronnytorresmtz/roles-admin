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


    public function getLogIn()
	{
		return View::make ('vueroute');
    }
   

	public function postLogIn(Request $request)
	{
		//Verify if the user has access to the application
		if ($this->loginService->verifyUserLogin($request)){
			Event::fire(new RegisterTransactionAccessEvent('login.login.login'));
			return response()->json('The user is authorize to access the application', 200);
		}
		return response()->json('The username or password are not correct', 401);
	}

	
	public function getUserAuthenticated()
	{

		if (Auth::check()){
			return response()->json('OK', 200);
		}

		return response()->json('NOK', 200);

	}

	
	public function getLogOut()
	{
		// check if the user is loggeded 
		if (Auth::check()){
			Event::fire(new RegisterTransactionAccessEvent('login.login.logout'));
			Auth::logout();
		}
		return redirect()->route('/');
	}


	public function postSendYourPassword(Request $request)
	{	
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


	public function postResetYourPassword(Request $request)
	{

		$result=[];

		$result = $this->userRepository->resetUserPassowrd($request);

		if (! $result['error']){

		//	Event::fire(new RegisterTransactionAccessEvent('login.login.resetUserPassword'));

			return response()->json($result, 200);
		}

		return response()->json($result, 200);
	}


	public function getTokenExist(Request $request)
	{

		return response()->json($this->userRepository->findToken($request), 200);
	}

}