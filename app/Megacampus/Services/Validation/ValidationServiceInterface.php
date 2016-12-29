<?php namespace Megacampus\Services\Validation;

Interface ValidationServiceInterface {
	
	/**
	* Validate the form imputs against the rules and return messages define in the model (ex User Model)
	*
	* @param 	$model: 	Model which keep the rules and messages for the user
	*			$input: 	All the inputs from the request
	*			$form: 		A form Name to be use to get the rules form the model
	*			$messages: 	The language file which has the messages for the user view
	*
	* @return 	$validador  Return the validator object
	*/
	public function validateInputs($model, $request, $form, $messages);
	
	/**
	* Get one id checked from the table
	*
	* @param 	$request: 	All the inputs from the request
	*			$message: 	True to store a message in the Session 
	*
	* @return 	CheckItem: Return the first id checked
	*/
	public function getIdChecked($request, $message);

	/**
	* Get all id checked from the table
	*
	* @param 	$request: 	 All the inputs from the request
	*			$message: 	 True to store a message in the Session 
	*			
	* @return 	$CheckItems: Return all Id´s checked
	*/
	public function getAllIdChecked($request, $message);

	/**
	* Get the a File from the user request / user input
	*
	* @param 	$request: 	All the inputs from the request
	*			$message: 	True to store a message in the Session 
	*
	* @return 	$file: 		Return the file name
	*/

	public function getFile($request, $message);


}