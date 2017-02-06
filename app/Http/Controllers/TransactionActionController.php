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
use MyCode\Repositories\TransactionAction\TransactionActionRepositoryInterface;
use MyCode\Repositories\Transaction\TransactionRepositoryInterface;


class TransactionActionController extends Controller {


  protected $transactionActionRepository;
  protected $transactionRepository;

  private $itemsByPage = 10;

	public function __construct(TransactionActionRepositoryInterface $transactionActionRepository,
							    TransactionRepositoryInterface $transactionRepository)
    {
    $this->transactionActionRepository = $transactionActionRepository;
    $this->transactionRepository       = $transactionRepository;
    }

		public function postSecurityTransactionsActionsUsedByDay(Request $request)
    {
     	Event::fire(new RegisterTransactionAccessEvent('security.dashboard.actions'));

    	$transactionActionUsedByDay = $this->transactionActionRepository->getTransactionsActionsUsedbyDay($request);

    	return response()->json($transactionActionUsedByDay, 200);
    }


    public function getSecurityTransactionsActionsUsed(Request $request)
    {
    	  $transactionActionUsed = $this->transactionActionRepository->getTransactionsActionsUsed($request, $this->itemsByPage);
      	
      	return response()->json($transactionActionUsed, 200);
    }


    public function postSecurityTransactionsActionsUsedByMonth(Request $request)
    {
    	$transactionActionUsedByMonth = $this->transactionActionRepository->getTransactionsActionsUsedByMonth($request);

    	return response()->json($transactionActionUsedByMonth, 200);
    }
	

    

}	