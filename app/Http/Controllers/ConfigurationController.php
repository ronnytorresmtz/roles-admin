<?php

/**
 * Controller Name: ConfigurationController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Configurations Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\Configuration\ConfigurationRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface as UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface as ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface as DocumentServiceInterface;


class ConfigurationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $configurationRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;


	private $directory_files = "settings/configurations";

	private $itemsByPage = 100;


	public function __construct(ConfigurationRepositoryInterface $configurationRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService)
	{
		$this->configurationRepository = $configurationRepository;
		$this->urlService              = $urlService;
		$this->validationService       = $validationService;
		$this->documentService         = $documentService;
	}


	public function index()
	{
		$this->urlService->forgetUrlPrevious();

		Event::fire(new RegisterTransactionAccessEvent('settings.configurations.index'));

	  	return View::make($this->directory_files .'/list')
			->with(
				array(
					'configurations' => $this->configurationRepository->paginate($this->itemsByPage),
					'create_link'    => 'Add Configuration',
					'label_search'   => null,
					'search_value'   => null
				));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$this->urlService->getUrlPrevious($this->directory_files);

	  	return View::make($this->directory_files .'/create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */	
	public function store(Request $request)
	{
		// validate the fields base on the rules define
		$validator=$this->validationService->validateInputs($this->configurationRepository->getModel(), $request->all(), 'configuration.add', 'validation.configurations');
		// Send to view the errros messages and the input data
		if ($validator->fails()) {

			return redirect()->route('settings.configurations.create')->withInput()->withErrors($validator);
		} 			
	
		if ($this->configurationRepository->store($request)){

			Event::fire(new RegisterTransactionAccessEvent('settings.configurations.store'));
		}

			
		return redirect()->route('settings.configurations.create');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$this->urlService->setUrlPrevious();
		// find a configuration id to access its information
		Event::fire(new RegisterTransactionAccessEvent('settings.configurations.view'));
        //show configuration info in the view
        return View::make($this->directory_files .'/show')
        	->with('configuration', $this->configurationRepository->find($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$this->urlService->getUrlPrevious($this->directory_files);
        //show the edit form and pass the configuration
        return View::make($this->directory_files .'/edit')
            ->with('configuration', $this->configurationRepository->find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		// validate the fields base on the rules define
		$validator=$this->validationService->validateInputs($this->configurationRepository->getModel(), $request->all(), 'configuration.update', 'validation.configurations');
        // Send to view the errors messages
        if ($validator->fails()) {

        	return redirect()->route('settings.configurations.edit', $id)->withErrors($validator);
        } 
        // update the data to the database
	 	if ($this->configurationRepository->update($id, $request)){

	 		Event::fire(new RegisterTransactionAccessEvent('settings.configurations.update'));	
	 	}
			
		return redirect()->to(URL::current() . '/edit');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete the $id in the database
      	if ($this->configurationRepository->delete($id)){

      		Event::fire(new RegisterTransactionAccessEvent('settings.configurations.delete'));
      	}
	 	//return to the previous url in case the delete fail
      	return redirect()->back();
	}

	/**
	 * Search a string input by the user.
	 *
	 * @return Response
	 */
	public function getSearch(Request $request) 
	{
		$value= $request->input('search_value');
		//set a color tag with the fileter
		$label_search= $value;

		Event::fire(new RegisterTransactionAccessEvent('settings.configurations.search'));
		//make the view and return the item filtered
		return View::make($this->directory_files .'/list')
			->with(
				array(
				'configurations' => $this->configurationRepository->search($value, $this->itemsByPage),
				'create_link'    => 'Add Configuration',
				'label_search'   => $label_search,
				'search_value'   => $value
				));
    	
	}

	/**
	 * Export all configurationas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data = $this->configurationRepository->getModel()->all();

		if ($this->documentService->export($data, 'csv', 'Configurations')){

			Event::fire(new RegisterTransactionAccessEvent('settings.configurations.export'));
		}

		return redirect()->back();

	}


	public function getSelectImportFile() 
	{ 

		$this->urlService->getUrlPrevious($this->directory_files);
        //show the import form 
        return View::make($this->directory_files .'/import');
	}

	
	public function postImport(Request $request) 
	{ 

		$file= $this->validationService->getFile($request, true);
		//validate the request if file is missing send an error to user
	
		if (isset($file)) {
				
			if ($this->configurationRepository->import($file)){

				Event::fire(new RegisterTransactionAccessEvent('settings.configurations.import'));
			}

		}
		//Redirect to the import page
	   	return redirect()->to(URL::route('settings.configurations.import_file'));
	}
 

	public function postViewButton(Request $request)
	{

		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){
		
			return redirect()->back();
		}

		return redirect()->route('settings.configurations.show', $checked_item);
	}	


	public function postEditButton(Request $request)
	{
		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){

			return redirect()->back();
		}

		return redirect()->route('settings.configurations.edit', $checked_item);
	}	


	public function postDeleteButton(Request $request)
	{

		$checked_items= $this->validationService->getAllIdChecked($request, true);	

		if ($checked_items !== 0){
		
			foreach ($checked_items as $id) {

				$this->destroy($id);
		    }
		}

		return redirect()->back();
	}	



}	