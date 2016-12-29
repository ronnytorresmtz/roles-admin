<?php

/**
 * Controller Name: ModuleController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Modules Information
 * 
 * Author: 
 *<203></203>
  */


use Illuminate\Http\Request;
use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Services\Log\LogServiceInterface;



class ApplicationLogController  extends Controller {

	protected $logService;

	
	public function __construct(LogServiceInterface $logService)
	{
		
		$this->logService = $logService;
	}


	
	public function index(Request $request)
	{
		
		$result=$this->logService->getMessagesFromLaravelLogFiles();

		Event::fire(new RegisterTransactionAccessEvent('settings.applicactionLog.view'));

		return View::make('settings.application_log.view_log')->with(array('logFile'=>$result));
	}

}	