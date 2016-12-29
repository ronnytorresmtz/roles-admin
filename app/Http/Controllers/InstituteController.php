<?php

/**
 * Controller Name: InstituteController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Institutes Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\Institute\InstituteRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface as UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface as ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface as DocumentServiceInterface;


class InstituteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	protected $instituteRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;

	private $directory_files = "facilities/institutes";

	private $itemsByPage = 100;


	public function __construct(InstituteRepositoryInterface $instituteRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService)
	{
		$this->instituteRepository = $instituteRepository;
		$this->urlService          = $urlService;
		$this->validationService   = $validationService;
		$this->documentService     = $documentService;
	}


	public function index()
	{
		$this->urlService->forgetUrlPrevious();

		Event::fire(new RegisterTransactionAccessEvent('facilities.institutes.index'));

		Session::put('instituteIDSelected', 1);

	  	return View::make($this->directory_files .'/list')
			->with(
				array(
					'institutes'   => $this->instituteRepository->paginate($this->itemsByPage),
					'create_link'  => 'Add Institute',
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
		$validator=$this->validationService->validateInputs($this->instituteRepository->getModel(), $request->all(), 'institute.add', 'validation.institutes');
		// Send to view the errros messages and the input data
		if ($validator->fails()) {

			return redirect()->route('facilities.institutes.create')->withInput()->withErrors($validator);
		} 			
	
		if ($this->instituteRepository->store($request)){

			Event::fire(new RegisterTransactionAccessEvent('facilities.institutes.store'));
		}

			
		return redirect()->route('facilities.institutes.create');
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

		Event::fire(new RegisterTransactionAccessEvent('facilities.institutes.view'));
        //show institute info in the view
        return View::make($this->directory_files .'/show')
        	->with('institute', $this->instituteRepository->find($id));
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
        //show the edit form and pass the institute
        return View::make($this->directory_files .'/edit')
            ->with('institute', $this->instituteRepository->find($id));
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
		$validator=$this->validationService->validateInputs($this->instituteRepository->getModel(), $request->all(), 'institute.update', 'validation.institutes');
        // Send to view the errors messages
        if ($validator->fails()) {

        	return redirect()->route('facilities.institutes.edit', $id)->withErrors($validator);
        } 
        // update the data to the database
	 	if ($this->instituteRepository->update($id, $request)){

	 		Event::fire(new RegisterTransactionAccessEvent('facilities.institutes.update'));	
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
      	if ($this->instituteRepository->delete($id)){

      		Event::fire(new RegisterTransactionAccessEvent('facilities.institutes.delete'));
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

		Event::fire(new RegisterTransactionAccessEvent('facilities.institutes.search'));
		//make the view and return the item filtered
		return View::make($this->directory_files .'/list')
			->with(
				array(
				'institutes'   => $this->instituteRepository->search($value, $this->itemsByPage),
				'create_link'  => 'Add Institute',
				'label_search' => $label_search,
				'search_value' => $value
				));
    	
	}

	/**
	 * Export all instituteas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data = $this->instituteRepository->getModel()->all();

		if ($this->documentService->export($data, 'csv', 'Institutes')){

			Event::fire(new RegisterTransactionAccessEvent('facilities.institutes.export'));
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
				
			if ($this->instituteRepository->import($file)){

				Event::fire(new RegisterTransactionAccessEvent('facilities.institutes.import'));
			}

		}
		//Redirect to the import page
	   	return redirect()->to(URL::route('facilities.institutes.import_file'));
	}
 

	public function postViewButton(Request $request)
	{

		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){
		
			return redirect()->back();
		}

		return redirect()->route('facilities.institutes.show', $checked_item);
	}	


	public function postEditButton(Request $request)
	{
		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){

			return redirect()->back();
		}

		return redirect()->route('facilities.institutes.edit', $checked_item);
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