<?php namespace Megacampus\Services\Login;


Interface LoginServiceInterface {

	/**
	* Verify the user credentials to access the application
	*
	* @param 	$request: username, password and remember flag
	*
	* @return 	Boolean: Return True if the user can access the application if not return false
	*/
	public function verifyUserLogin($request);

}
	