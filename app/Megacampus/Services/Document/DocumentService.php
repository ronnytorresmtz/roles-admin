<?php namespace Megacampus\Services\Document;


use App\Events\RegisterTransactionAccessEvent;

use Auth, Exception, Event, Lang, Session, DB;

class DocumentService implements DocumentServiceInterface 
{

	public function export($data, $fileType, $sheetName)
	{
		try {
		
			\Excel::create($sheetName, function($excel) use($data, $sheetName) {
				//create a excel sheet
		        $excel->sheet($sheetName, function($sheet) use($data){
		        	// insert the programs to excel sheet
		        	$sheet->fromArray($data);		        	

		        	Session::flash('info', Lang::get('messages.success'));

		        	$exported=true;
	        	});
	        // export to a file
	    	})->export($fileType);

			return $exported;

		
		} catch (Exception $e) {
	    	//Set the message error to display

	    	Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
			
			$exported=false;
		}

	}

}