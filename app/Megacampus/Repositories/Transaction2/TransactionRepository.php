<?php namespace Megacampus\Repositories\Transaction;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Services\Graph\GraphServiceInterface;
use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\Transaction\TransactionRepositoryInterface;

use  DB, Exception, Lang, Transaction, Session;
 
class TransactionRepository extends MyAbstractEloquentRepository implements TransactionRepositoryInterface 
{
 
	// Properties

	protected $model;
	protected $graphService;

	 
	//Constructor
	   
	public function __construct(Transaction $model, GraphServiceInterface $graphService) 
	{
		$this->model        = $model; 
		$this->graphService = $graphService;

	}


	public function getModel()
	{
	
		return  $this->model;
	}


	public function getAllTransactionsByPage($itemsByPage)
	{
		$transactions=$this->model->withTrashed()->select(
			'transactions.id', 
			'modules.module_name',
			'transactions.transaction_name',
			'transactions.transaction_description',
			'transactions.transaction_order',
			'transactions.deleted_at',
			'transactions.created_at',
			'transactions.updated_at')

		->join('modules', 'transactions.module_id','=', 'modules.id')

		->orderby('transactions.module_id', 'ASC')
		->orderby('transactions.transaction_order', 'ASC')
		

		->paginate($itemsByPage);

		return $transactions;
	}

	public function getAllTransactionsActiveByPage($itemsByPage)
	{
		$transactions=$this->model->select(
			'transactions.id', 
			'modules.module_name',
			'transactions.transaction_name',
			'transactions.transaction_description',
			'transactions.transaction_order',
			'transactions.created_at',
			'transactions.updated_at')

		->join('modules', 'transactions.module_id','=', 'modules.id')

		->orderby('transactions.module_id', 'ASC')
		->orderby('transactions.transaction_order', 'ASC')
		

		->paginate($itemsByPage);

		return $transactions;
	}


	public function getAllTransactions()
	{
		$transactions=$this->model->select(

			'transactions.id', 
			'modules.module_name',
			'transactions.transaction_name',
			'transactions.transaction_description',
			'transactions.transaction_order',
			'transactions.created_at',
			'transactions.updated_at'
			)

		->join('modules', 'transactions.module_id','=', 'modules.id')

		->orderby('transactions.id', 'ASC')

		->get();

		return $transactions;
	}


	public function getAllTransactionsByModuleId($moduleId)
	{
		$transactions=$this->model->select(

			'transactions.id', 
			'modules.module_name',
			'transactions.transaction_name',
			'transactions.transaction_description',
			'transactions.transaction_order',
			'transactions.created_at',
			'transactions.updated_at'
			)

		->join('modules', 'transactions.module_id','=', 'modules.id')
		
		->where ('transactions.module_id','=', $moduleId)

		->orderby('transactions.id', 'ASC')

		->get();

		return $transactions;
	}


	public function getAllTransactionsByModuleName($moduleName)
	{
		$transactions=$this->model->select(

			'transactions.id', 
			'modules.module_name',
			'transactions.transaction_name',
			'transactions.transaction_description',
			'transactions.transaction_order',
			'transactions.created_at',
			'transactions.updated_at'
			)

		->join('modules', 'transactions.module_id','=', 'modules.id')
		
		->where ('modules.module_name','=', $moduleName)

		->orderby('transactions.id', 'ASC')

		->get();

		return $transactions;
	}


	public function getTransactionIdByTransactionName($transactionName)
	{

		$transactionId=$this->model->select('id')

		->where ('transaction_name','=', $transactionName)

		->get();

		if (count($transactionId)==0){
			return 0;
		}

		return $transactionId[0]->id;
	}


		
	public function store($request)
	{
		try{
			// store the data to the database
			$model                          = new $this->model;		
			
			$model->module_id               = $request->input('module_name');
			$model->transaction_name        = $request->input('transaction_name');
			$model->transaction_description = $request->input('transaction_description');
			$model->transaction_order       = $request->input('transaction_order');
			
			if (! $model->save()){

				Session::flash('error', Lang::get('messages.error'));

				return false;

			}

			Session::flash('info', Lang::get('messages.success'));

			return true;

		} catch (Exception $e) {
			
			Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));

			return false;
		}

	}


	public function update($id, $request)
	{
		try{
			// store the data to the database
			$model = $this->model->find($id);

			$model->module_id               = $request->input('module_name');  
			$model->transaction_name        = $request->input('transaction_name');
			$model->transaction_description = $request->input('transaction_description');
			$model->transaction_order       = $request->input('transaction_order');
			
			$model->touch();
			
			if (! $model->update()){

				Session::flash('error', Lang::get('messages.error'));

				return false;
			}

			Session::flash('info', Lang::get('messages.success'));

			return true;

		} catch (Exception $e) {
			
			Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));

			return false;
		}
	}


	public function delete($id)
	{
		try{
			// find a transaction id to delete it
			$model = $this->model->find($id);
			//validate if $id was not found
			if ( ! isset($model)) {
		     	//return to the previous url
		     	Session::flash('error', Lang::get('messages.error'));

		      	return false;
			}

			if (! $model->delete()){

				Session::flash('error', Lang::get('messages.error'));

				return false;
			}

			Session::flash('info', Lang::get('messages.success'));

			return true;


		} catch (Exception $e) {
			
			Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));

			return false;
		}
	}



	public function search($value, $itemsByPage)
	{

	// find the string in the database and return the transactions found
	$transactions=$this->model->select(

			'transactions.id', 
			'modules.module_name',
			'transactions.transaction_name',
			'transactions.transaction_description',
			'transactions.transaction_order',
			'transactions.created_at',
			'transactions.updated_at'

		)->join('modules', 'transactions.module_id',' =', 'modules.id')
		 ->where(function ($query) use ($value){
		 	$query->where('transactions.transaction_name','like','%' . $value . '%')
		 		  ->orwhere('transactions.transaction_description','like','%' . $value . '%')
		 		  ->orwhere('modules.module_name','like','%' . $value . '%');
		 })

		->orderby('transactions.module_id', 'ASC')
		->orderby('transactions.transaction_order', 'ASC')
		 
		 ->paginate($itemsByPage);

	return $transactions;

	}


	public function import($moduleRepository, $file)
	{

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		try {
			//load the file to the database	
			$transactions=\Excel::load($file->getRealPath(), function($reader) use ($moduleRepository){
				//get the file content / data
				$results = $reader->get();	
				$i=0; // caount add records
				$j=0; // count update records
				foreach ($results as $key => $row)  {
					// Validate if the file uploaded has the ID field
					if (isset($row)) {
						// find the id to decide if it wil be an update or add process
						$rowId= $this->model->find($row->id);
						
						$moduleId=$moduleRepository->getModuleIdByModuleName($row->module_name);

						if ( ! isset($moduleId)){
							
							Session::flash('error', Lang::get('messages.error_module_name') . $row->module_name);
 
							return false;
						}

						//validate if $id was found so UPDATE it
						if ($rowId) {
							$rowId->module_id               = $moduleId;
							$rowId->transaction_name        = $row->transaction_name;
							$rowId->transaction_description = $row->transaction_description;
							$rowId->transaction_order       = $row->transaction_order;
							$rowId->touch();  			
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{

							$rowId                          = new $this->model;
							$rowId->module_id               = $moduleId;
							$rowId->transaction_name        = $row->transaction_name;
							$rowId->transaction_description = $row->transaction_description;
							$rowId->transaction_order       = $row->transaction_order;
							$rowId->save();
							$i++;
						}
					}
				}
				

				// Store the message information for the user in the Session Object
				if (($i+$j)==0){
					//messages.error_file_format'
					Session::flash('error', Lang::get('messages.error') . '<br> <br> <em>' . Lang::get('messages.error_file_format') . '</em>');

					DB::rollBack();

					return false;
				}else{
					//messages.successfully'
					Session::flash('info', Lang::get('messages.success_add') .'&nbsp;' .  $i .'&nbsp;' . Lang::get('messages.success_update') .'&nbsp;' . $j .'&nbsp;' . Lang::get('messages.successfully'));
					
					DB::commit();
					
					return true;
				} 
				
			})->get();

	    } catch (Exception $e) {
	    	//Set the message error to display
			Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
			//Rollback the Transaction
			DB::rollBack();

			return false;
		}

	}


	public function getChartAmountTransactionsUsedByDay($request, $month, $year)
    {

    	$transactionsByMonthDay = DB::select('
      	 	Select month, day, count(*) amountOfTransactions
      	 	From
				(Select month(created_at) as month, day(created_at) as day, transaction_name  
					From users_actions_log
                    Where month(created_at) = ' . $month . ' and year(created_at) =' . $year .
                    ' Group By month, day, transaction_name) as TransactionbyMonth

				Group By month, day'
		);

		$d=getdate();
      	//reset all days with 0
      	for ($i=1; $i < cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) { 
      		
  			if ($year<$d['year']){
  				$transactionsByDay[]=0;
      		}
			else{
	      		if (($i>$d['mday']) && ($month==$d['mon']) || ($year>$d['year'])) {
	      			$transactionsByDay[]=null;
	      		} 
	      		else {
	      			$transactionsByDay[]=0;
	      		}
      		}

      	}
      	//fill days with values
      	foreach ($transactionsByMonthDay as $dayAndValue) {
      		$transactionsByDay[$dayAndValue->day-1]=$dayAndValue->amountOfTransactions;
      	}
           	
      	if ($request->ajax()){
      		// retrun just the series data to update the graph
      		return $transactionsByDay;
      	}

      	//return the graph definition to make a graph
		$chartByDay=$this->graphService->makeDailyGraph('line', Lang::get('labels.transactions'), $transactionsByDay, 'amount_transactions_used_by_day');	    
		
		return $chartByDay;
	}


	public function getChartAmountTransactionsUsedByMonth($request, $year)
	{
			$transactionsByMonth = DB::select('
      	 	Select month,  count(*) amountOfTransactions
      	 	From
				(Select month(created_at) as month, transaction_name  
					From users_actions_log
                    Where year(created_at) = ' . $year .
                    ' group by month, transaction_name) as TransactionsbyMonth
				Group By month'
		);
		//reset all month with 0	
      	for ($i=0; $i < 12; $i++) { 
      		$MonthAndValues[]=0;
      	}
      	//fill months with values
      	foreach ($transactionsByMonth as $transactionsByMonth) {
      		$MonthAndValues[$transactionsByMonth->month-1]=$transactionsByMonth->amountOfTransactions;
      	}

      	if ($request->ajax()){
      		// retrun just the series data to update the graph
      		return $MonthAndValues;
      	}

	    //make a graph
		$chartByMonth=$this->graphService->makeMonthlyGraph('column', Lang::get('labels.transactions'), $MonthAndValues, 'shortMonths', 'amount_transactions_used_by_month');		
	    	
		return $chartByMonth;

	}


	public function getTransactionsUsed($month, $year)
	{
		$transactionsUsed = DB::select("
			SELECT module_name, transaction_name, count(id) as amountOfTransactionsActions 
			FROM users_actions_log 
			where month(created_at) = " . $month . " and year(created_at) =" . $year .
			" group by module_name, transaction_name
			order by amountOfTransactionsActions desc"
		);

		return $transactionsUsed;
    }
	

}

