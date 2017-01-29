<?php namespace MyCode\Services\AccessRights;


Interface AccessRightsServiceInterface {

	/**
	* Make a Hightlight Graph
	*
	* @param 	$request: 
	*
	* @return 	Boolean: 
	*/
	public function hasAccessToModule($module);
	public function hasAccessToModuleTransactionForAction($module, $transaction, $action);

}