<?php

/**
 * Controller Name: CustomerController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Customers Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\Customer\CustomerRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface;


class CustomerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $customerRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;

	private $baseRoute = 'security.customers';

	private $itemsByPage = 100;



	public function __construct(CustomerRepositoryInterface $customerRepository,
															UrlServiceInterface $urlService, 
															ValidationServiceInterface $validationService,
															DocumentServiceInterface $documentService)
	{
		$this->customerRepository    = $customerRepository;
		$this->urlService        = $urlService;
		$this->validationService = $validationService;
		$this->documentService   = $documentService;
	}


	public function index()
	{

		$customers=$this->customerRepository->getAllCustomers($this->itemsByPage);

		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.index'));

		return response()->json($customers, 200);

	}

	public function getAllCustomersActive()
	{
		
		$customers=$this->customerRepository->getAllCustomersActive(null);

	  return response()->json($customers, 200);
	}


	public function getAllCustomersActivbyPage()
	{
		
		$customers=$this->customerRepository->getAllCustomersActive($this->itemsByPage);

	  return response()->json($customers, 200);
	}


	public function show()
	{

	}

	public function edit()
	{

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
		$result=$this->validationService->validateInputs($this->customerRepository->getModel(), $request->all(), 'customer.add', 'validation.customers');
		// Send to view the errros messages and the input data
		if (! $result['error']){

			$result = $this->customerRepository->store($request);

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
		$result=$this->validationService->validateInputs($this->customerRepository->getModel(), $request->all(), 'customer.update', 'validation.customers');
      // Send to view the errors messages
    if (! $result['error']){
  	// update the data to the database
  	\Debugbar::info($request);
    	$result=$this->customerRepository->update($id, $request);

		 	if (! $result['error']){

		 		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute  . '.update'));

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
		$result=$this->customerRepository->delete($id);

		if (! $result['error']){

			Event::fire(new RegisterTransactionAccessEvent($this->baseRoute  . '.delete'));		

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
		//get all the customers found with the filter applied	
		$customers=$this->customerRepository->search($value, $this->itemsByPage);
		//set a color tag with the fileter
		//$label_search= $value;
		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.search'));
		//make the view and return the item filtered
		return response()->json($customers, 200);
    	
	}

	/**
	 * Export all customeras to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data= $this->customerRepository->getModel()->all();

		$result=$this->documentService->export($data, 'csv', 'Customer');

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
			
			$result=$this->customerRepository->importFile($file);

			if (! $result['error']){

				Event::fire(new RegisterTransactionAccessEvent($this->baseRoute .'.import'));

				return response()->json($result, 200);
			}

		}
		
		return response()->json($result, 400);
	}

}	