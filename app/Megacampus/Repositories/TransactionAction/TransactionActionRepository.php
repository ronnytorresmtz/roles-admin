<?php namespace Megacampus\Repositories\TransactionAction;
 
//use Maatwebsite\Excel\Excel as Excel;
use Megacampus\Services\Graph\GraphServiceInterface;
use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\TransactionAction\TransactionActionRepositoryInterface;

use  DB, Lang, UserActionLog, TransactionAction, Session;
 
class TransactionActionRepository extends MyAbstractEloquentRepository implements TransactionActionRepositoryInterface 
{
 
	// Properties

	protected $model;
	protected $graphService;

	 
	//Constructor
	   
	public function __construct(TransactionAction $model, GraphServiceInterface $graphService) 
	{
		$this->model = $model; 
		$this->graphService = $graphService;
	}


	public function getModel()
	{
	
		return  $this->model;
	}


	public function getAllTransactionActions()
	{

		$transaction_actions=$this->model->all(array('transaction_action_name','id'));

		return $transaction_actions;
	}

	public function getTransactionActionNameByID($id)
	{

		$transaction_action=$this->model->where('id', '=', $id)->first();

		return $transaction_action;
	}

	public function getTransactionActionIdByTransactionActionName($transactionActionName)
	{

		$transaction_action=$this->model->where('transaction_action_name', '=', $transactionActionName)->first(array('id'));

		$id=null;

		if (isset($transaction_action)){
			
			$transaction_action=$transaction_action->toArray();

			$id= array_pop($transaction_action);
		}

		return $id;
	}

	public function getTransactionsActionsUsedbyDay($request)
    {
		$transactionsActionsByMonthDay = DB::select('
			Select 
				year, 
				month, 
				day, 
				count(*) transactionsActions 
			From            
				(Select  
					year(created_at) year, 
					month(created_at) month, 
					day(created_at) day, 
					module_name, 
					transaction_name, 
					action_name  
				From users_actions_log
				Where year(created_at) =' . $request->year . ' and  month(created_at) =' . $request->month . 
				' Group by year, month, module_name, transaction_name, action_name
				) as ActionbyMonth
			Group by year, month, day'
		);

		$daysArray=[];
		$currentDate=getdate();
		//reset all days with 0 for the days of the month (30,31,28,29)
		for ($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $request->month , $request->year); $i++) { 

			array_push($daysArray, $i);

			if ($request->year < $currentDate['year']){
					$transactionsActionsByDay['series'][]=0;
			}	else {
			if (($i > $currentDate['mday']) && ($request->month == $currentDate['mon']) || ($request->year > $currentDate['year'])) {
				$transactionsActionsByDay['series'][]=null;
			} 
			else {
				$transactionsActionsByDay['series'][]=0;
			}
			}
		}
		
		//fill days with values
		foreach ($transactionsActionsByMonthDay as $dayAndValue) {
			$transactionsActionsByDay['series'][$dayAndValue->day-1]=$dayAndValue->transactionsActions;
		}
		
		$transactionsActionsByDay['labels'] = $daysArray; 
		$transactionsActionsByDay['legend'] = ['Actions'];

		return $transactionsActionsByDay;
				
    }


  	public function getTransactionsActionsUsed($request, $itemsByPage)
	{
		$transactionsActionsUsed = UserActionLog::select(DB::raw(
				'module_name, 
				transaction_name,
				action_name,
				count(id) as timeslogged'
		))

		->whereMonth('created_at','=', $request->month)
		->whereYear('created_at','=', $request->year)
		->groupBy('module_name','transaction_name','action_name')
		->orderBy ('timeslogged', 'desc')

		->paginate($itemsByPage);

		return $transactionsActionsUsed;

  	}

    public function getTransactionsActionsUsedByMonth($request)
	{
		$transactionsActionsByMonth = DB::select('
			Select 
				year, 
				month, 
				count(*) transactionsActions 
			From            
				(Select  
					year(created_at) year, 
					month(created_at) month, 
					module_name, 
					transaction_name, 
					action_name  
				From users_actions_log
				Where year(created_at) =' . $request->year .  
				' Group by year, month, module_name, transaction_name, action_name
				) as ActionbyMonth
			Group by year, month'
		);

    	//reset all month with 0	
    	for ($i=0; $i < 12; $i++) { 
    		$MonthAndValues['series'][]=0;
    	}

    	//fill months with values
    	foreach ($transactionsActionsByMonth as $transactionActionByMonth) {
    		$MonthAndValues['series'][$transactionActionByMonth->month-1] = $transactionActionByMonth->transactionsActions;
    	}

    	$MonthAndValues['labels'] = Lang::get('calendar.shortMonths'); //shortMonths, longMonths, numericMonths
     	$MonthAndValues['legend'] = ['Actions'];
    	// retrun just the series data to update the graph
   		return $MonthAndValues;
    }
	

}