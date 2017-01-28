<?php namespace MyCode\Services\Log;

use Lang, File;

class LogService implements LogServiceInterface {

	
	public function getMessagesFromLaravelLogFiles()
	{
		$data=array();
		$result=array();

		$allFiles= File::allFiles(storage_path() .'\logs');
		foreach($allFiles as $file)
		{	
			//get the log file of the array of log file in $allFiles
			$logfile=file($file);

			// loop the log file line by line
			foreach($logfile as $line)
			{	
				 // Check if the line contains the string we're looking for
				 $dateTime=strtok($line, ']');

				 if (substr($dateTime,0,1)=="["){

				 	//get date time from the file line
					$dateTime=strtok($line, ']');
					$dateTime=substr($dateTime,1,strlen($dateTime));

					//get message from the file line
					$message = substr($line, strpos($line, "]") + 1);  

					//get the message type ERROR / INFO / etc.
					$type=strtok($message, ':');
					$type = substr($type, strpos($message, ".") + 1); 

					//Eliminate the text ERROR / INFO from the message
					$message = substr($message, strpos($message, ":") + 1); 

					$data['type']=$type;
					$data['date_time']=$dateTime;
				    $data['message']=$message;
				    $data['file']=$file;

				    array_push($result,$data);
				 }
			}
		}

		return array_reverse($result);
	}

}