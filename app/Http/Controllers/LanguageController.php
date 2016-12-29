<?php

/**
 * Controller Name: LanguageController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Languages Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\Language\LanguageRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface as UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface as ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface as DocumentServiceInterface;


class LanguageController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $languageRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;

	private $directory_files = "data/languages";

	private $itemsByPage = 100;



	public function __construct(LanguageRepositoryInterface $languageRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService)
	{
		$this->languageRepository = $languageRepository;
		$this->urlService         = $urlService;
		$this->validationService  = $validationService;
		$this->documentService    = $documentService;
	}


	public function index()
	{
		$this->urlService->forgetUrlPrevious();

		Event::fire(new RegisterTransactionAccessEvent('data.languages.index'));

	  	return View::make($this->directory_files .'/list')
			->with(
				array(
					'languages'    => $this->languageRepository->paginate($this->itemsByPage),
					'create_link'  => 'Add Language',
					'label_search' => null,
					'search_value' => null
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
		$validator=$this->validationService->validateInputs($this->languageRepository->getModel(), $request->all(), 'language.add', 'validation.languages');
		// Send to view the errros messages and the input data
		if ($validator->fails()) {

			return redirect()->route('data.languages.create')->withInput()->withErrors($validator);
		} 			
	
		if ($this->languageRepository->store($request)){

			Event::fire(new RegisterTransactionAccessEvent('data.languages.store'));
		}

			
		return redirect()->route('data.languages.create');
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

		Event::fire(new RegisterTransactionAccessEvent('data.languages.view'));
        //show language info in the view
        return View::make($this->directory_files .'/show')
        	->with('language', $this->languageRepository->find($id));
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
        //show the edit form and pass the language
        return View::make($this->directory_files .'/edit')
            ->with('language', $this->languageRepository->find($id));
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
		$validator=$this->validationService->validateInputs($this->languageRepository->getModel(), $request->all(), 'language.update', 'validation.languages');
        // Send to view the errors messages
        if ($validator->fails()) {

        	return redirect()->route('data.languages.edit', $id)->withErrors($validator);
        } 
        // update the data to the database
	 	if ($this->languageRepository->update($id, $request)){

	 		Event::fire(new RegisterTransactionAccessEvent('data.languages.update'));	
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
      	if ($this->languageRepository->delete($id)){

      		Event::fire(new RegisterTransactionAccessEvent('data.languages.delete'));
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

		Event::fire(new RegisterTransactionAccessEvent('data.languages.search'));
		//make the view and return the item filtered
		return View::make($this->directory_files .'/list')
			->with(
				array(
					'languages'    => $this->languageRepository->search($value, $this->itemsByPage),
					'create_link'  => 'Add Language',
					'label_search' => $label_search,
					'search_value' => $value
				));
    	
	}

	/**
	 * Export all languageas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data = $this->languageRepository->getModel()->all();

		if ($this->documentService->export($data, 'csv', 'Languages')){

			Event::fire(new RegisterTransactionAccessEvent('data.languages.export'));
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
				
			if ($this->languageRepository->import($file)){

				Event::fire(new RegisterTransactionAccessEvent('data.languages.import'));
			}

		}
		//Redirect to the import page
	   	return redirect()->to(URL::route('data.languages.import_file'));
	}
 

	public function postViewButton(Request $request)
	{

		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){
		
			return redirect()->back();
		}

		return redirect()->route('data.languages.show', $checked_item);
	}	


	public function postEditButton(Request $request)
	{
		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){

			return redirect()->back();
		}

		return redirect()->route('data.languages.edit', $checked_item);
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