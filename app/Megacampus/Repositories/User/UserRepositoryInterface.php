<?php namespace Megacampus\Repositories\User;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface UserRepositoryInterface extends MyEloquentRepositoryInterface
{
	
	/**
	* Get the Input Rules from User Model
	*
	* @param 	$form: A form Name to be use to get the rules form the model
	* * @param 	$request: All request data
	*
	* @return: 	Array Return and array with the validation rules define in the model
	*/
	public function getInputRules($form, $request);

	/**
	* Get the Input Messages from User Model
	*
	* @param 	$langFileAttributes: The language file which has the messages for the user view
	*
	* @return: 	Array Return and array with the validation messages define in the model
	*/
	public function getInputMessages($langFileAttributes);

	/**
	* Send a email to the user with a token and security code to reset the user password
	*
	* @param 	$input: The Request Inputs which contain the email to be use to send the mail
	*
	* @return:	 Boolean Return True if the Token and Security Code was sent to the user if not False
	*/
	public function sendTokenToUserViaMail($request); 

	/**
	* Reset the user password
	*
	* @param 	$input: The Request Inputs which contain the security code, new password and confirmation passwod to be used to reset the password
	*
	* @return: 	Boolean Return True if the Password was reset if not False
	*/
	public function resetUserPassowrd($request);

	
	
	public function getModel();
	public function getAllUsersByPage($itemsByPage);
	public function getAllUsers();
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($modelRepository, $file);
	public function getUsersLoggedbyDay($request);
	public function getUsersLoggedbyMonth($request);
	public function getUsersLogged($request, $itemsByPage);

 
}