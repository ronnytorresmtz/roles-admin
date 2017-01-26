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
use Megacampus\Repositories\Module\ModuleRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface;


class ModuleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $moduleRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;

	private $baseRoute = 'security.modules';

	private $itemsByPage = 10;



	public function __construct(ModuleRepositoryInterface $moduleRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService)
	{
		$this->moduleRepository  = $moduleRepository;
		$this->urlService        = $urlService;
		$this->validationService = $validationService;
		$this->documentService   = $documentService;
	}


	public function index()
	{

		$modules=$this->moduleRepository->getAllModules($this->itemsByPage);

		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.index'));

		return response()->json($modules, 200);

	}

	public function getAllModulesActive()
	{
		
		$modules=$this->moduleRepository->getAllModulesActive(null);

	  	return response()->json($modules, 200);
	}


	public function getAllModulesActivbyPage()
	{
		
		$modules=$this->moduleRepository->getAllModulesActive($this->itemsByPage);

	  	return response()->json($modules, 200);
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
		$result=$this->validationService->validateInputs($this->moduleRepository->getModel(), $request->all(), 'module.add', 'validation.modules');
		// Send to view the errros messages and the input data
		if (! $result['error']){

			$result = $this->moduleRepository->store($request);

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
		$result=$this->validationService->validateInputs($this->moduleRepository->getModel(), $request->all(), 'module.update', 'validation.modules');
      // Send to view the errors messages
    if (! $result['error']){
  	// update the data to the database
    	$result=$this->moduleRepository->update($id, $request);

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
		$result=$this->moduleRepository->delete($id);

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
		//get all the modules found with the filter applied	
		$modules=$this->moduleRepository->search($value, $this->itemsByPage);
		//set a color tag with the fileter
		//$label_search= $value;
		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.search'));
		//make the view and return the item filtered
		return response()->json($modules, 200);
    	
	}

	/**
	 * Export all moduleas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data= $this->moduleRepository->getModel()->all();

		$result=$this->documentService->export($data, 'csv', 'Module');

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
			
			$result=$this->moduleRepository->importFile($file);

			if (! $result['error']){

				Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.import'));

				return response()->json($result, 200);
			}

		}
		
		return response()->json($result, 400);
	}


	public function postSecurityModulesUsedByDay(Request $request)
    {
     	Event::fire(new RegisterTransactionAccessEvent('security.dashboard.modules'));
    	$moduleUsedByDay = $this->moduleRepository->getModulesUsedbyDay($request);

    	return response()->json($moduleUsedByDay, 200);
    }


    public function getSecurityModulesUsed(Request $request)
    {
    	$moduleUsed = $this->moduleRepository->getModulesUsed($request, $this->itemsByPage);
      	
      	return response()->json($moduleUsed, 200);
    }


    public function postSecurityModulesUsedByMonth(Request $request)
    {
    	$moduleUsedByMonth = $this->moduleRepository->getModulesUsedByMonth($request);

    	return response()->json($moduleUsedByMonth, 200);
    }

}	