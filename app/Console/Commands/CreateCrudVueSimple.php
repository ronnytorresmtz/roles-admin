<?php namespace App\Console\Commands;


use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

use Log, Artisan, File;


class CreateCrudVueSimple extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $signature = 'crudVue:make';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a general CRUD funcionality with Vue v1 Framework';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		// User Input	
		$argument=$this->getUserInput();
		
		//Create CRUD Files
		$this->createTable($argument);
		$this->createSeeder($argument);
		$this->updateDatabaseSeeder($argument);

		exec('composer dump-autoload');

		$this->createModel($argument);
		
		$this->createRoutes($argument);
		$this->createController($argument);
		$this->createRepository($argument);
		$this->createRepositoryInterface($argument);
		$this->createViews($argument);
		$this->updateAppBindInAppServiceProvider($argument);
		$this->updateLanguages($argument);
		$this->updateValidations($argument);
		$this->updateRouterMap($argument);

		exec('composer dump-autoload');

		$this->loadDatabaseTable();
		// Mesage for User
		$this->displayFinalConsoleMessage($argument);
		
		return true;
	}

	public function getUserInput()
	{
		// User Input
		$modelCBox=$this->choice('Select the crud type to be generated ?', array('simple', 'with combo box'),0);

		if (strcmp($modelCBox,'simple')!=0){
			$modelCBoxs = $this->ask('What is the Model Name of the ComboBox in Plural?');
			$modelCBox = $this->ask('What is the Model Name of the ComboBox in Singular?');
		}
		else{
			$modelCBoxs = '';
		}

		
		$argument=array(
			'p' => strtolower($this->ask('What is the Model Name of the CRUD in Plural?')),
			's' => strtolower($this->ask('What is the Model Name of the CRUD in Singular?')),
			'm' => strtolower($this->ask('What is the Menu Name where the Model will be Linked?')),
			'x' => strtolower($modelCBoxs),
			'o' => strtolower($modelCBox)
		);

		return $argument;
	}


	public function createTable($argument)
	{

		Artisan::call('make:migration', array('name'=>'create_modelTemplates_table'));

		if (strcmp($argument['o'],'simple')==0){
			$templateDirAndFile=base_path() . '\vue-templates\Migrations\Create_Table_Template.php';	
		}else{
			$templateDirAndFile=base_path() . '\vue-templates\Migrations\CBox\Create_Table_Template_CBox.php';	
		}

		$modelNew=$this->replaceTemplateFileContentWithModelName($argument, $templateDirAndFile);

		$fileName=$this->getCreateTableFileGeneratedAsTemplate();

		$this->replaceCreateTemplateTableFileContent($argument, $fileName, $modelNew);		

		$this->renameCreateTemplateTableFile($argument, $fileName);
		
		$this->displayConsoleMessage('Table');
	}

	public function createSeeder($argument)
	{

		if (strcmp($argument['o'],'simple')==0){
			$templateFileName = base_path() . '\vue-templates\Seeds\TableSeeder_Template.php';
		}else{
			$templateFileName = base_path() . '\vue-templates\Seeds\CBox\TableSeeder_Template_CBox.php';
		}

		$seedsDir         = base_path() . '\database\seeds';
		$modelFileName    = $seedsDir . '\\' . ucfirst($argument['p']) . 'TableSeeder.php';

		File::copy($templateFileName, $modelFileName);

		$this->replaceFileContent($argument, $modelFileName, $modelFileName);

		$this->displayConsoleMessage('Seeder');

		return true;

	}


	public function updateDatabaseSeeder($argument)
	{

		$templateDirAndFile=base_path() . '\vue-templates\seeds\DatabaseSeeder_Template.php';

		$modelNew=$this->replaceTemplateFileContentWithModelName($argument, $templateDirAndFile);

		$databaseSeedrDirAndFile = base_path() . '\database\seeds\DatabaseSeeder.php';

		$databaseSeeder=File::get($databaseSeedrDirAndFile);
		//Generate a timestamp 
		$dateTime=str_replace(':','_', str_replace('-','_', Carbon::now()));
		//Store the Original file as a backup 
		file_put_contents(base_path() . '\vue-templates\Seeds\OldSeeds\DatabaseSeeder_' . $dateTime . '.php', $databaseSeeder);

		$databaseSeederChanged=str_replace('//TableSeeder_Template Don´t Delete this Line', $modelNew , $databaseSeeder);

		File::put($databaseSeedrDirAndFile, $databaseSeederChanged);
		
		$this->displayConsoleMessage('DatabaseSeeder');

		return true;

	}

	public function loadDatabaseTable()
	{

		Artisan::call('migrate:refresh');

		Artisan::call('db:seed');

		$this->displayConsoleMessage('migrate and db:seed');

		return true;
	}


	public function createModel($argument)
	{
		//Create Model
		$this->replaceFileContent(	
			$argument, 
			base_path() . '\vue-templates\Models\Model_Template.php', 
			app_path() . '\MyCode\Models\\' . ucfirst($argument['s']) . '.php');
		//Display a user message
		$this->displayConsoleMessage('Model');

		return true;
	}


	public function createRoutes($argument)
	{

		if (strcmp($argument['o'],'simple')==0){
			$templateFile=base_path() . '\vue-templates\Routes\Routes_Template.php';
		}else{
			$templateFile=base_path() . '\vue-templates\Routes\CBox\Routes_Template_CBox.php';
		}

		// Check if directory exist for the Model in the Rouste directory
		$this->createDirectoryIfNotExist(app_path()  . '\Http\Routes\\' . ucfirst($argument['m']));
		//Create Routes
		$this->replaceFileContent(
			$argument, 
			$templateFile, 
			app_path()  . '\Http\Routes\\' . ucfirst($argument['m']) . '\\' . $argument['p'] . '.php');
		//Display a user message
		 $this->displayConsoleMessage('Routes');

		 return true;
	}


	public function createController($argument)
	{

		if (strcmp($argument['o'],'simple')==0){
			$templateFile=base_path() . '\vue-templates\Controllers\Controller_Template.php';
		}else{
			$templateFile=base_path() . '\vue-templates\Controllers\CBox\Controller_Template_CBox.php';
		}

		//Create Controller		
		$this->replaceFileContent(
			$argument,
			$templateFile,
			app_path()  . '\Http\Controllers\\' . ucfirst($argument['s']) . 'Controller.php');
		//Display a user message
		$this->displayConsoleMessage('Controller');

		return true;
	}


	public function createRepository($argument)
	{
		// Check if directory exist for the Model in the Repositories
		$this->createDirectoryIfNotExist(app_path()  . '\MyCode\Repositories\\' . ucfirst($argument['s']));

		if (strcmp($argument['o'],'simple')==0){
			$templateFile=base_path() . '\vue-templates\Repositories\Repository_Template.php';
		}else{
			$templateFile=base_path() . '\vue-templates\Repositories\CBox\Repository_Template_CBox.php';
		}
		// Create Repository
		$this->replaceFileContent(
			$argument,
			$templateFile,
			app_path()  . '\MyCode\Repositories\\' . ucfirst($argument['s']) . '\\' . ucfirst($argument['s']) . 'Repository.php');
		//Display a user message
		$this->displayConsoleMessage('Repository');

		return true;

	}


	public function createRepositoryInterface($argument)
	{

		if (strcmp($argument['o'],'simple')==0){
			$templateFile=base_path() . '\vue-templates\Repositories\RepositoryInterface_Template.php';
		}else{
			$templateFile=base_path() . '\vue-templates\Repositories\CBox\RepositoryInterface_Template_CBox.php';
		}
		// Create Repository Interface
		$this->replaceFileContent(
			$argument,
			$templateFile,
			app_path()  . '\MyCode\Repositories\\' . ucfirst($argument['s']) . '\\' . ucfirst($argument['s']) . 'RepositoryInterface.php');
		//Display a user message
		$this->displayConsoleMessage('RepositoryInterface');

		return true;
	}


	public function createViews($argument)
	{
		// Check if Menu directory exist in the Views directory
		$this->createDirectoryIfNotExist(base_path() . '\resources\views\\' . $argument['m']);
		// Check if model directory exist in the Menu directory for the Views directory
		$this->createDirectoryIfNotExist(base_path() . '\resources\views\\' . $argument['m'] . '\\' .  $argument['p']);
		//Set an array with the prefix for each view to be generated
		//$actionsView = array('create', 'edit', 'import', 'list', 'show');
		$actionsView = array('view');
		//Loop the array with the prefix for each view to be generated
		foreach ($actionsView as $actionView) {
			//Create the Action View
			if (strcmp($argument['o'],'simple')==0){
				$templateDirAndFile = base_path() . '\vue-templates\Views\\' . ucfirst($actionView) .'_Template.vue';
			}else{
				$templateDirAndFile = base_path() . '\vue-templates\Views\CBox\\' . ucfirst($actionView) .'_Template_CBox.vue';
			}

			$newDirAndFile      = base_path() . '\resources\assets\js\views\\' . $argument['m'] . '\\' . ucfirst($argument['p']) .'.vue';

			$this->replaceFileContent($argument,  $templateDirAndFile, $newDirAndFile);
		}
		//Display a user message
		$this->displayConsoleMessage('Views');
		
		return true;
	}


	public function updateAppBindInAppServiceProvider($argument)
	{
		$directory = 'Providers';
		//Get text to insert in the AppServiceProvider
		$modelNew = array(
			'AppBind'          => $this->replaceTemplateTextWithModel('AppBind_Template.php', $argument, $directory),
			'AppUseModel'      => $this->replaceTemplateTextWithModel('AppUseModel_Template.php', $argument, $directory),
			'AppUseRepository' => $this->replaceTemplateTextWithModel('AppUseRepository_Template.php', $argument, $directory)
		);
		//Get the File to be modified
		$modelActual=file_get_contents(app_path() . '\Providers\AppServiceProvider.php');
		//Generate a timestamp 
		$dateTime=str_replace(':','_', str_replace('-','_', Carbon::now()));
		//Store the Original in the templates\provider\oldAppServiceProvider  as a backup of the orginal file
		file_put_contents(base_path() . '\vue-templates\Providers\OldAppServiceProvider\AppServiceProvider_' . $dateTime . '.php', $modelActual);
		//Add the new text replacing a comment
		//App_Use_Repository_Template Don´t Delete This Line
		$modelActualChanged=str_replace('//AppUseModel_Template Don´t Delete This Line', $modelNew['AppUseModel'], $modelActual);
		$modelActualChanged=str_replace('//AppUseRepository_Template Don´t Delete This Line', $modelNew['AppUseRepository'], $modelActualChanged);
		$modelActualChanged=str_replace('//AppBind_Template Don´t Delete This Line', $modelNew['AppBind'], $modelActualChanged);
		//Generate the new file (orginal + new text)
		file_put_contents(app_path() . '\Providers\AppServiceProvider.php', $modelActualChanged);
		//Display a user message
		$this->displayConsoleMessage('App->Bind');

		return true;
	}

	
	public function updateLanguages($argument)
	{
		$directory = 'Lang';
		//Get text to insert in the Translation File
		$modelNew = array(
			'Traslations' => $this->replaceTemplateTextWithModel('Traslations_Template.php', $argument, $directory)
		);
		//Get the File to be modified
		$modelActual=file_get_contents(base_path() . '\resources\assets\js\components\languages\Traslations.vue');
		//Generate a timestamp 
		$dateTime=str_replace(':','_', str_replace('-','_', Carbon::now()));
		//Store the Original in the templates\provider\oldAppServiceProvider  as a backup of the orginal file
		file_put_contents(base_path() . '\vue-templates\lang\OldLang\\' . 'Traslations' . '_' . $dateTime . '.vue', $modelActual);
		//Add the new text replacing a comment
		$modelNew=str_replace('//Traslations_Template Don´t Delete This Line', $modelNew['Traslations'], $modelActual);
		//Generate the new file (orginal + new text)
		file_put_contents(base_path() . '\resources\assets\js\components\languages\Traslations.vue', $modelNew);
		
		//Display a user message
		$this->displayConsoleMessage('Languages');

		return true;

	}

	public function updateValidations($argument)
	{
		$directory = 'Lang';
		//Get text to insert in the Translation File
		$modelNew = array(
			'Validations' => $this->replaceTemplateTextWithModel('Validations_Template.php', $argument, $directory)
		);

		$lang = array('0' => 'en', '1' => 'sp');

		//for ($i=0; $i < count($lang); $i++) { 
			//Get the File to be modified
			$modelActual=file_get_contents(base_path() . '\resources\lang\en\validation.php');
			//Generate a timestamp 
			$dateTime=str_replace(':','_', str_replace('-','_', Carbon::now()));
			//Store the Original in the templates\provider\oldAppServiceProvider  as a backup of the orginal file
			file_put_contents(base_path() . '\vue-templates\lang\OldLang\\' . 'validation' . '_' . $dateTime . '.php', $modelActual);
			//Add the new text replacing a comment
			$modelNew=str_replace('//Validation_Template Don´t Delete This Line', $modelNew['Validations'], $modelActual);
			//Generate the new file (orginal + new text)
			file_put_contents(base_path() . '\resources\lang\en\validation.php', $modelNew);
	//	}
		//Display a user message
		$this->displayConsoleMessage('Validations');

		return true;

	}

	public function updateRouterMap($argument)
	{
		$directory = 'RouterMap';
		//Get text to insert in the RouterMapr
		$modelNew = array(
			//'Component' => $this->replaceTemplateTextWithModel('Component_Template.php', $argument, $directory),
			'Link'      => $this->replaceTemplateTextWithModel('Link_Template.php', $argument, $directory)
			);
		//Get the File to be modified
		$modelActual=file_get_contents(base_path() . '\resources\assets\js\vueroute.js');
		//Generate a timestamp 
		$dateTime=str_replace(':','_', str_replace('-','_', Carbon::now()));
		//Store the Original in the templates\provider\oldARouterMap  as a backup of the orginal file
		file_put_contents(base_path() . '\vue-templates\RouterMap\OldRouterMap\vueroute_' . $dateTime . '.js', $modelActual);
		//Add the new text replacing a comment
		//App_Use_Repository_Template Don´t Delete This Line
		//$modelActualChanged=str_replace('//Component_Template Don´t Delete This Line', $modelNew['Component'], $modelActual);
		$modelActualChanged=str_replace('//Link_Template Don´t Delete This Line', $modelNew['Link'], $modelActualChanged);
		//Generate the new file (orginal + new text)
		file_put_contents(base_path() . '\resources\assets\js\vueroute.js', $modelActualChanged);
		//Display a user message
		$this->displayConsoleMessage('Router Map');

		return true;
	}


	public function replaceTemplateTextWithModel($file, $argument, $directory)
	{
		//Get the template content to insert in the AppServiceProvider
		$modelActual = file_get_contents(base_path() . '\vue-templates\\' . $directory . '\\' . $file);
		//Replace the the templante keys with the Model Name  
		$modelNew=str_replace('ucfirstModelTemplate', ucfirst($argument['s']), $modelActual);
		$modelNew=str_replace('modelTemplates', $argument['p'], $modelNew);
		$modelNew=str_replace('modelTemplate', $argument['s'], $modelNew);
		$modelNew=str_replace('menuTemplate', $argument['m'], $modelNew);

		return $modelNew;
	}


	public function createDirectoryIfNotExist($directory)
	{
		// Check if directory exist 
		if ( ! file_exists($directory)){
			//remove directory
			mkdir($directory);
			//Display a user message
			$this->info($directory . ' created successfully');
		}
		
		return true;
	}

	
	public function replaceFileContent($argument, $templateDirAndFile, $newDirAndFile)
	{
		//Get the content of the source file
		$modelActual=file_get_contents($templateDirAndFile);
		//Replace the got content  
		$modelNew=str_replace('ucfirstModelTemplates', ucfirst($argument['p']), $modelActual);
		$modelNew=str_replace('ucfirstModelTemplate', ucfirst($argument['s']), $modelNew);
		$modelNew=str_replace('modelTemplates', $argument['p'], $modelNew);
		$modelNew=str_replace('modelTemplate', $argument['s'], $modelNew);
		$modelNew=str_replace('menuTemplate', $argument['m'], $modelNew);
		$modelNew=str_replace('ucfirstSelectTemplates', ucfirst($argument['x']), $modelNew);
		$modelNew=str_replace('ucfirstSelectTemplate', ucfirst($argument['o']), $modelNew);
		$modelNew=str_replace('selectTemplates', $argument['x'], $modelNew);
		$modelNew=str_replace('selectTemplate', $argument['o'], $modelNew);
		
		//Generate the destination file 
		file_put_contents($newDirAndFile, $modelNew);

		return true;

	}	

	public function replaceTemplateFileContentWithModelName($argument, $templateDirAndFile)
	{
		$modelActual = file_get_contents($templateDirAndFile);
		//Replace the the templante keys with the Model Name  
		
		$modelNew=str_replace('ucfirstModelTemplates', ucfirst($argument['p']), $modelActual);
		$modelNew=str_replace('modelTemplates', $argument['p'], $modelNew);
		$modelNew=str_replace('modelTemplate', $argument['s'], $modelNew);
		$modelNew=str_replace('selectTemplate', $argument['o'], $modelNew);
		
		return $modelNew;
	}

	public function getCreateTableFileGeneratedAsTemplate()
	{
		$files=File::allFiles(base_path() . '\database\migrations');

		foreach ($files as $file) {
			if (! strpos($file, 'modelTemplates') == 0){
				$fileName=$file; 	
				break;
			}
		}

		return $fileName;
	}

	public function replaceCreateTemplateTableFileContent($argument, $fileName, $modelNew)
	{
		file_put_contents($fileName, $modelNew);

		return true;
	}
	
	public function renameCreateTemplateTableFile($argument, $fileName)
	{
		$fileNewName=str_replace('modelTemplates', $argument['p'], $fileName);

		rename($fileName, $fileNewName);

		return true;
	}


	public function displayConsoleMessage($fileGenerated)
	{
		//Display a console message
		$this->info(ucfirst($fileGenerated) . ' created successfully');

		return true;
	}


	public function displayFinalConsoleMessage($argument)
	{
		$this->info('=================================================================');
		$this->info('');
		$this->info('CrudVue:make Results:');
		$this->info('');
		$this->info('All files for the (' . ucfirst($argument['s']) . ') Model were created successfully');
		$this->info('');
		$this->info('The Menu Name is: ' . ucfirst($argument['m']) .' add the next line in the SubMenu.vue and change de index:');
		$this->info('   "0":{"title": "' . ucfirst($argument['p']) . '", "method": "/' . $argument['p'] . '"},');
		$this->info('');
		$this->info('Review the Traslation.vue File for the spanish languague');
		$this->info('');
		$this->info('==================================================================');

		return true;
	}
}

