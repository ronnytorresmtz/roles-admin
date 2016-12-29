<?php

/**
 * Controller Name: TransactionController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Transactions Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\Transaction\TransactionRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface;


class TransactionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $transactionRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;

	private $baseRoute = 'security.transactions';

	private $itemsByPage = 9;



	public function __construct(TransactionRepositoryInterface $transactionRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService)
	{
		$this->transactionRepository    = $transactionRepository;
		$this->urlService       		= $urlService;
		$this->validationService 		= $validationService;
		$this->documentService   		= $documentService;
	}


	public function index()
	{

		$transactions=$this->transactionRepository->getAllTransactions($this->itemsByPage);

		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.index'));

		return response()->json($transactions, 200);

	}

	public function getAllTransactionsActive()
	{
		
		$transactions=$this->transactionRepository->getAllTransactionsActive(null);

	  return response()->json($transactions, 200);
	}


	public function getAllTransactionsActivbyPage()
	{
		
		$transactions=$this->transactionRepository->getAllTransactionsActive($this->itemsByPage);

	  return response()->json($transactions, 200);
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
		$result=$this->validationService->validateInputs($this->transactionRepository->getModel(), $request->all(), 'transaction.add', 'validation.transactions');
		// Send to view the errros messages and the input data
		if (! $result['error']){

			$result = $this->transactionRepository->store($request);

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
		$result=$this->validationService->validateInputs($this->transactionRepository->getModel(), $request->all(), 'transaction.update', 'validation.transactions');
      // Send to view the errors messages
    if (! $result['error']){
  	// update the data to the database
    	$result=$this->transactionRepository->update($id, $request);

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
		$result=$this->transactionRepository->delete($id);

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
		//get all the transactions found with the filter applied	
		$transactions=$this->transactionRepository->search($value, $this->itemsByPage);
		//set a color tag with the fileter
		//$label_search= $value;
		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.search'));
		//make the view and return the item filtered
		return response()->json($transactions, 200);
    	
	}

	/**
	 * Export all transactionas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data= $this->transactionRepository->getModel()->all();

		$result=$this->documentService->export($data, 'csv', 'Transaction');

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
			
			$result=$this->transactionRepository->importFile($file);

			if (! $result['error']){

				Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.import'));

				return response()->json($result, 200);
			}

		}
		
		return response()->json($result, 400);
	}


    public function postSecurityTransactionsUsedByDay(Request $request)
    {
     	Event::fire(new RegisterTransactionAccessEvent('security.dashboard.transactions'));
    	$transactionsUsedByDay = $this->transactionRepository->getTransactionsUsedbyDay($request);

    	return response()->json($transactionsUsedByDay, 200);
    }


    public function getSecurityTransactionsUsed(Request $request)
    {
    	$transactionsUsed = $this->transactionRepository->getTransactionsUsed($request, $this->itemsByPage);
      	
      	return response()->json($transactionsUsed, 200);
    }


    public function postSecurityTransactionsUsedByMonth(Request $request)
    {
    	$transactionsUsedByMonth = $this->transactionRepository->getTransactionsUsedbyMonth($request);

    	return response()->json($transactionsUsedByMonth, 200);
    }


}	