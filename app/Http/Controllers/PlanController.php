<?php

/**
 * Controller Name: PlanController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Plans Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\Plan\PlanRepositoryInterface as PlanRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface as UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface as ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface as DocumentServiceInterface;


class PlanController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $planRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;

	private $directory_files = "academic/plans";

	private $itemsByPage = 10;



	public function __construct(PlanRepositoryInterface $planRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService)
	{
		$this->planRepository    = $planRepository;
		$this->urlService        = $urlService;
		$this->validationService = $validationService;
		$this->documentService   = $documentService;
	}


	public function index()
	{

		$plans=$this->planRepository->getAllPlans($this->itemsByPage);
				
		Event::fire(new RegisterTransactionAccessEvent('academic.plans.index'));

		return response()->json($plans, 200);
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
		$result=$this->validationService->validateInputs($this->planRepository->getModel(), $request->all(), 'plan.add', 'validation.plans');
		// Send to view the errros messages and the input data
		if (! $result['error']){

			$result = $this->planRepository->store($request);

			if (! $result['error']){
			
				Event::fire(new RegisterTransactionAccessEvent('academic.plans.store'));

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
		$result=$this->validationService->validateInputs($this->planRepository->getModel(), $request->all(), 'plan.update', 'validation.plans');
   		 // Send to view the errors messages
		if (! $result['error']){
	    	// update the data to the database
	      	$result=$this->planRepository->update($id, $request);

		 	if (! $result['error']){

		 		Event::fire(new RegisterTransactionAccessEvent('academic.plans.update'));

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
		$result=$this->planRepository->delete($id);

	  	if (! $result['error']){

	  		Event::fire(new RegisterTransactionAccessEvent('academic.plans.delete'));		

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
		//get all the plans found with the filter applied	
		$plans=$this->planRepository->search($value, $this->itemsByPage);

		\Debugbar::info($plans);
		//set a color tag with the fileter
		$label_search= $value;

		Event::fire(new RegisterTransactionAccessEvent('academic.plans.search'));

		return response()->json($plans);    	
	}

	/**
	 * Export all planas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 
		
		$data= $this->planRepository->getModel()->all();

		$result=$this->documentService->export($data, 'csv', 'Plan');

		if (! $result['error']){

			Event::fire(new RegisterTransactionAccessEvent('academic.plans.export'));

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
			
			$result=$this->planRepository->importFile($file);

			if (! $result['error']){

				Event::fire(new RegisterTransactionAccessEvent('academic.plans.import'));

				return response()->json($result, 200);
			}

		}
		
		return response()->json($result, 400);
	}

}	