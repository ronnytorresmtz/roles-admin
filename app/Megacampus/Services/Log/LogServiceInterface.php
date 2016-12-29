<?php namespace Megacampus\Services\Log;


Interface LogServiceInterface {

	/**
	* Make a Hightlight Graph
	*
	* @param 	$request: 
	*
	* @return 	Boolean: 
	*/
	public function getMessagesFromLaravelLogFiles();

}