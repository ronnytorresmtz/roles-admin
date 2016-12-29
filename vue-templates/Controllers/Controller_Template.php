<?php

/**
 * Controller Name: ucfirstModelTemplateController
 *
 * Description: Controller to list, insert, update, delete, search, export and import ucfirstModelTemplates Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\ucfirstModelTemplate\ucfirstModelTemplateRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface;


class ucfirstModelTemplateController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $modelTemplateRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;

	private $baseRoute = 'security.modelTemplates';

	private $itemsByPage = 100;



	public function __construct(ucfirstModelTemplateRepositoryInterface $modelTemplateRepository,
															UrlServiceInterface $urlService, 
															ValidationServiceInterface $validationService,
															DocumentServiceInterface $documentService)
	{
		$this->modelTemplateRepository    = $modelTemplateRepository;
		$this->urlService        = $urlService;
		$this->validationService = $validationService;
		$this->documentService   = $documentService;
	}


	public function index()
	{

		$modelTemplates=$this->modelTemplateRepository->getAllucfirstModelTemplates($this->itemsByPage);

		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.index'));

		return response()->json($modelTemplates, 200);

	}

	public function getAllucfirstModelTemplatesActive()
	{
		
		$modelTemplates=$this->modelTemplateRepository->getAllucfirstModelTemplatesActive(null);

	  return response()->json($modelTemplates, 200);
	}


	public function getAllucfirstModelTemplatesActivbyPage()
	{
		
		$modelTemplates=$this->modelTemplateRepository->getAllucfirstModelTemplatesActive($this->itemsByPage);

	  return response()->json($modelTemplates, 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */	
	public function store(Request $request)
	{
		$result = [];
		// validate the fields base on the rules define
		$result=$this->validationService->validateInputs($this->modelTemplateRepository->getModel(), $request->all(), 'modelTemplate.add', 'validation.modelTemplates');
		// Send to view the errros messages and the input data
		if (! $result['error']){

			$result = $this->modelTemplateRepository->store($request);

			if (! $result['error']){
			
				Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.store'));

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
		$result=$this->validationService->validateInputs($this->modelTemplateRepository->getModel(), $request->all(), 'modelTemplate.update', 'validation.modelTemplates');
      // Send to view the errors messages
    if (! $result['error']){
  	// update the data to the database
    	$result=$this->modelTemplateRepository->update($id, $request);

		 	if (! $result['error']){

		 		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.update'));

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
		$result=$this->modelTemplateRepository->delete($id);

		if (! $result['error']){

			Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.delete'));		

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
		//get all the modelTemplates found with the filter applied	
		$modelTemplates=$this->modelTemplateRepository->search($value, $this->itemsByPage);
		//set a color tag with the fileter
		//$label_search= $value;
		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.search'));
		//make the view and return the item filtered
		return response()->json($modelTemplates, 200);
    	
	}

	/**
	 * Export all modelTemplateas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data= $this->modelTemplateRepository->getModel()->all();

		$result=$this->documentService->export($data, 'csv', 'ucfirstModelTemplate');

		if (! $result['error']){

			Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.export'));

			return response()->json($result, 200); 
		}

		return response()->json($result, 400); 
	}



	
	public function postImport(Request $request) 
	{ 

		$result=[];

		$file=json_decode($request->input('values'), true);
		//validate the request if file is missing send an error to user
		if (! empty($file)) {
			
			$result=$this->modelTemplateRepository->importFile($file);

			if (! $result['error']){

				Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.import'));

				return response()->json($result, 200);
			}

		}
		
		return response()->json($result, 400);
	}

}	