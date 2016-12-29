<?php namespace Megacampus\Services\Url;

Interface UrlServiceInterface {

	/**
	* Store the a previous url key to the session object
	*
	* @param: 	None
	*
	* @return:	None
	*/
	public function setUrlPrevious ();

	/**
	* Get the previous url keya from the session object
	*
	* @param $option: a directory files that represent the url and it will be complement in this function to go back
	*
	* @return: None
	*/
	public function getUrlPrevious($option);

	/**	
	* Delete the previous url key from the session object
	*
	* @param: 	None
	*
	* @return: 	None
	*/
	public function forgetUrlPrevious();

}