<?php namespace App\Console\Commands;


use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

use Log, File;


class RollbackCRUD extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $signature = 'crud:delete';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete all files created by the CRUD funcionality for a Model';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->displayWatchOutMessage();

		$argument=$this->getUserInput();
		
		if ($this->confirm('Are you sure to delete the crud files (' . $argument['p'] . ' - ' . $argument['s'] . ' - ' . $argument['m'] . ')')){	
		
			$this->executeProcessDelete($argument);
			
			return true;

		} else {

			$this->info('Delete process was aborted');

			return false;
		}
	}


	public function displayWatchOutMessage(){
		
		$this->info('*******************************************************************');
		$this->info('*** WATCH OUT YOU ARE GOING TO DELETE ALL CRUD FILES OF A MODEL ***');
		$this->info('*******************************************************************');
	}


	public function getUserInput(){
		// User Input	
		$argument=array(
			'p' => strtolower($this->ask('What is the Model Name of the CRUD in Plural to delete?')),
			's' => strtolower($this->ask('What is the Model Name of the CRUD in Singular to delete?')),
			'm' => strtolower($this->ask('What is the Menu Name where the Model was Linked to delete?'))
		);


		/*$argument=array(
			'p' => 'buildings',
			's' => 'building',
			'm' => 'facilities'
		);*/

		return $argument;
	}

	public function executeProcessDelete($argument){

		// Create CRUD Files
		$this->deleteModel($argument);
		$this->deleteRoutes($argument);
		$this->deleteController($argument);
		$this->deleteRepository($argument);
		$this->deleteRepositoryInterface($argument);
		$this->deleteViews($argument);

		// Mesage for User
		$this->displayFinalConsoleMessage($argument);
		//Log::Info ('Create a general CRUD funcionality was executed successfully');
	}


	public function deleteModel($argument){

		$file = app_path() . '\MyCode\Models\\' . $argument['s'] . '.php';
		
		$this->deleteFile($file, $dir=null, 'Model');		

		return true;
	}


	public function deleteRoutes($argument){

		$dir = app_path()  . '\Http\Routes\\' . ucfirst($argument['m']);

		$file = $dir . '\\' . $argument['p'] . '.php';

		$this->deleteFile($file, $dir, 'Routes');

		 return true;
	}


	public function deleteController($argument){

		$file = app_path()  . '\Http\Controllers\\' . ucfirst($argument['s']) . 'Controller.php';
		
		$this->deleteFile($file, $dir=null, 'Controller');		

		return true;
	}


	public function deleteRepository($argument){

		$file = app_path()  . '\MyCode\Repositories\\' . ucfirst($argument['s']) . '\\' . ucfirst($argument['s']) . 'Repository.php';

		$this->deleteFile($file, $dir=null, 'Repository');				

		return true;
	}


	public function deleteRepositoryInterface($argument){

		$dir = app_path()  . '\MyCode\Repositories\\' . ucfirst($argument['s']);

		$file = $dir . '\\' . ucfirst($argument['s']) . 'RepositoryInterface.php';

		$this->deleteFile($file, $dir, 'RepositoryInterface');						

		return true;
	}


	public function deleteViews($argument){

		$actionsView = array('create', 'edit', 'import', 'list', 'show');

		$dir = base_path() . '\resources\views\\' . $argument['m'];

		foreach ($actionsView as $actionView) {

			$file=$dir . '\\' . $argument['p'] . '\\' . $actionView .'.blade.php';

			if (file_exists($file)){

				unlink($file);

			}
		}

		// Check if directory is empty to delete it
		$this->deleteDirectoryIfItIsEmpty($dir . '\\' .  $argument['p']);
		// Check if directory is empty to delete it
		$this->deleteDirectoryIfItIsEmpty($dir);

		$this->displayConsoleMessage('Views');
		
		return true;
	}


	public function deleteFile($file, $dir, $type){

		if (file_exists($file)){

			unlink($file);
		}
		
		if (! is_null($dir)){
			// Check if directory is empty to delete it
			$this->deleteDirectoryIfItIsEmpty($dir);
		}
				
		$this->displayConsoleMessage($type);

		return true;
	}


	public function deleteDirectoryIfItIsEmpty($dir){

		if (file_exists($dir)){

			if (empty(File::allFiles($dir))){
				
				rmdir($dir);

				$this->info($dir . ' delete successfully');
			}
		}
		
		return true;
	}


	public function displayConsoleMessage($fileGenerated){

		$this->info(ucfirst($fileGenerated) . ' deleted successfully');
	}


	public function displayFinalConsoleMessage($argument){

		$this->info('');
		$this->info('All files of CRUD (' . $argument['s'] . ') were deleted successfully');
		$this->info('');
		$this->info('');
		$this->info('********************** IMPORTANT *****************');
		$this->info('');
		$this->info('1) Rollback Manually the Lang Files (field.php, labels.php, validation.php) from the templates directory (OldLang directory)');
		$this->info('');
		$this->info('2) Rollback Manually the AppServiceProvider File from the templates directory (OldAppServiceProvider)');
		$this->info('');
		$this->info('**************************************************');

		return true;
	}
}
