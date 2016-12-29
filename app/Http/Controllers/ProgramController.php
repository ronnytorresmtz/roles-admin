<?php

/**
 * Controller Name: ProgramController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Programs Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\Program\ProgramRepositoryInterface as ProgramRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface as UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface as ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface as DocumentServiceInterface;


class ProgramController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $programRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;

	private $directory_files = "academic/programs";

	private $itemsByPage = 10;



	public function __construct(ProgramRepositoryInterface $programRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService)
	{
		$this->programRepository = $programRepository;
		$this->urlService        = $urlService;
		$this->validationService = $validationService;
		$this->documentService   = $documentService;
	}


	public function index()
	{
		$programs=$this->programRepository->getAllProgramsByPage($this->itemsByPage);
				
		Event::fire(new RegisterTransactionAccessEvent('academic.programs.index'));

		return response()->json($programs);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */	
	
	public function store (Request $request)
	{
		$result = [];
		// validate the fields base on the rules define
		$result=$this->validationService->validateInputs($this->programRepository->getModel(), $request->all(), 'program.add', 'validation.programs');
		// Send to view the errros messages and the input data
		if (! $result['error']){

			$result = $this->programRepository->store($request);

			if (! $result['error']){
			
				Event::fire(new RegisterTransactionAccessEvent('academic.programs.store'));

				return response()->json($result, 200);
			}

		}

		return response()->json($result, 400);
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
		$result=$this->validationService->validateInputs($this->programRepository->getModel(), $request->all(), 'program.update', 'validation.programs');
    // Send to view the errors messages
    if (! $result['error']){
      // update the data to the database
      $result = $this->programRepository->update($id, $request);

		 	if (! $result['error']){

		 		Event::fire(new RegisterTransactionAccessEvent('academic.programs.update'));

		 		return response()->json($result, 200);
		 	}

	 	}

		return response()->json($result, 400);
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
		$result = $this->programRepository->delete($id);

  	if (! $result['error']){

  		Event::fire(new RegisterTransactionAccessEvent('academic.programs.delete'));	

  		return response()->json($result, 200);
  	}

	 	return response()->json($result, 400); 
	}

	/**
	 * Search a string input by the user.
	 *
	 * @return Response
	 */
	public function getSearch(Request $request) 
	{
		$value= $request->input('searchText');
		//get all the programs found with the filter applied	
		$programs=$this->programRepository->search($value, $this->itemsByPage);
		//set a color tag with the fileter
		$label_search= $value;

		Event::fire(new RegisterTransactionAccessEvent('academic.programs.search'));

		return response()->json($programs);    	
	}

	/**
	 * Export all programas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		
		$data= $this->programRepository->getAllPrograms();
		
		if ($this->documentService->export($data, 'csv', 'Program')){

			Event::fire(new RegisterTransactionAccessEvent('academic.programs.export'));
		}

		return response()->json(array('error' => false, 'message' => 'Request was executed successfully'), 200); 

	}


	public function getSelectImportFile() 
	{ 

		$this->urlService->getUrlPrevious($this->directory_files);
        //show the import form 
        return View::make($this->directory_files .'/import');
	}

	
	public function postImport(Request $request) 
	{ 
		//$file= $this->validationService->getFile($request, true);
		$file=json_decode($request->input('values'), true);
		//validate the request if file is missing send an error to user
		if (! empty($file)) {
			//if ($this->programRepository->import($file)){
			if ($this->programRepository->importFile($file)){
				Event::fire(new RegisterTransactionAccessEvent('academic.programs.import'));
			}

		}
		
		return response()->json(array('error' => false, 'message' => 'Request was executed successfully'), 200);
	}
 
}	