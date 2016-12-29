<?php namespace Megacampus\Repositories\Transaction;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\Transaction\TransactionRepositoryInterface;

use  DB, Exception, UserActionLog, Lang, Transaction, Session;
 
class TransactionRepository extends MyAbstractEloquentRepository implements TransactionRepositoryInterface 
{
 
	// Properties

	protected $model;

	 
	//Constructor
	   
	public function __construct(Transaction $model) 
	{
	    $this->model = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}

	public function getAllTransactions($itemsByPage)
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

	public function getAllTransactionsActive($itemsByPage = null)
	{

		if ($itemsByPage)
			$transactions=$this->model->select(['id','transaction_name'])->select(
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
		else
			$transactions=$this->model->select(['id','transaction_name'])->select(
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

	
	public function getTransactionByID($id)
	{

		$transaction=$this->model->where('id', '=', $id)->first();

		return $transaction;
	}

	public function getTransactionIDByTransactionName($transactionName)
	{

		$transactionID=$this->model->where('transaction_name', '=', $transactionName)->first();

		return $transactionID->id;
	}

	public function store($request)
	{
		try{
			// store the data to the database
			$model                   				= new Transaction;		
			
			$model->module_id       				= $request->input('module_name');
			$model->transaction_name        = $request->input('transaction_name');
			$model->transaction_description = $request->input('transaction_description');
			$model->transaction_order       = $request->input('transaction_order');
			
			if (! $model->save()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e) {
			
			 return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}	

	}


	public function update($id, $request)
	{
		try{
			// store the data to the database
			$model = $this->model->withTrashed()->find($id);

			$model->module_id       				= $request->input('module_name');
			$model->transaction_name        = $request->input('transaction_name');
			$model->transaction_description = $request->input('transaction_description');
			$model->transaction_order       = $request->input('transaction_order');
			$model->deleted_at       = null;

			$model->touch();
			
			if (! $model->update()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e) {

			return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}	
	}


	public function delete($id){

		try{
			// find a transaction id to delete it
			$model = $this->model->withTrashed()->find($id);
			//validate if $id was not found
			if (! $model->delete()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e) {
			
			return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}	
	}


	public function search($value, $itemsByPage)
	{

		// find the string in the database and return the transactions found
		return 	$this->model->withTrashed()->select(
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

		->where('transactions.id','like','%' . $value . '%')
		->orwhere(function ($query) use ($value){
			$query->orwhere('modules.module_name','like','%' . $value . '%')
						->orwhere('transactions.transaction_name','like','%' . $value . '%')
						->orwhere('transactions.transaction_description','like','%' . $value . '%')
						->orwhere('transactions.transaction_order','like','%' . $value . '%');

		})

		->paginate($itemsByPage);
	}


	public function importFile($file)
	{

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		try {

			$addedRecords=0; // caount add records
			$updateRecords=0; // count update records

			for ($i=1; $i <count($file) ; $i++) { 
				
				//validate if $id was found so UPDATE it
				if (array_key_exists('id', $file[$i])) {
		
					$rowId = $this->model->find($file[$i]['id']);
					
					$rowId->module_name        			= $file[$i]['module_name'];
					$rowId->transaction_name        = $file[$i]['transaction_name'];
					$rowId->transaction_description = $file[$i]['transaction_description'];
					$rowId->transaction_order				= $file[$i]['transaction_order'];
					$rowId->deleted_at       				= null;

					$rowId->touch();  			//touch: update timestamps
					$rowId->save();
					$updateRecords++;
				}
				// validate no found so ADD it
				else{

					$rowId                  				= new $this->model;

					$rowId->module_name        			= $file[$i]['module_name'];
					$rowId->transaction_name        = $file[$i]['transaction_name'];
					$rowId->transaction_description = $file[$i]['transaction_description'];
					$rowId->transaction_order				= $file[$i]['transaction_order'];
					$rowId->deleted_at       = null;

					$rowId->save();
					$addedRecords++;
				}

			}

			if (($addedRecords+$updateRecords)==0){
				//messages.error_file_format'
				DB::rollBack();

				return array('error' => true, 'message' => Lang::get('messages.error') . '<br> <br> <em>' . Lang::get('messages.error_file_format') . '</em>');
			}else{
				//messages.successfully'
				DB::commit();
				
				return array('error' => false, 'message' => Lang::get('messages.success_add') .'&nbsp;' .  $addedRecords .'&nbsp;' . Lang::get('messages.success_update') .'&nbsp;' . $updateRecords .'&nbsp;' . Lang::get('messages.successfully'));
			} 
	   } catch (Exception $e) {
				DB::rollBack();

				return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}
			
	}	


	public function getTransactionsUsedbyDay($request)
    {
		$transactionsByMonthDay = DB::select('
		Select month, day, count(*) transactions 
		From
			(Select 
				month(created_at) as month, day(created_at) as day, transaction_name  
				From users_actions_log
			Where month(created_at) = ' . $request->month . ' and year(created_at) =' . $request->year . 
			' group by month, day, transaction_name) as TransactionbyMonth

			Group By month, day'
		);

		$daysArray=[];
		$currentDate=getdate();
		//reset all days with 0 for the days of the month (30,31,28,29)
		for ($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $request->month , $request->year); $i++) { 

			array_push($daysArray, $i);

			if ($request->year < $currentDate['year']){
					$transactionByDay['series'][]=0;
			}	else {
			if (($i > $currentDate['mday']) && ($request->month == $currentDate['mon']) || ($request->year > $currentDate['year'])) {
				$transactionByDay['series'][]=null;
			} 
			else {
				$transactionByDay['series'][]=0;
			}
			}
		}
		
		//fill days with values
		foreach ($transactionsByMonthDay as $dayAndValue) {
			$transactionByDay['series'][$dayAndValue->day-1]=$dayAndValue->transactions;
		}
		
		$transactionByDay['labels'] = $daysArray; //shortMonths, longMonths, numericMonths
		$transactionByDay['legend'] = ['Transactions'];

		return $transactionByDay;
				
    }


  	public function getTransactionsUsed($request, $itemsByPage)
	{
		$transactionsUsed = UserActionLog::select(DB::raw(
			'module_name, 
			transaction_name, 
			count(id) as timeslogged'
		))

		->whereMonth('created_at','=', $request->month)
		->whereYear('created_at','=', $request->year)
		->groupBy('module_name', 'transaction_name')
		->orderBy ('timeslogged', 'desc')

		->paginate($itemsByPage);

		return $transactionsUsed;

   }


    public function getTransactionsUsedbyMonth($request)
	{
		$transactionsByMonth = DB::select('
			Select month, count(*) transactions 
			From
			(Select 
				month(created_at) as month, transaction_name  
				From users_actions_log
			Where year(created_at) =' . $request->year . 
			' group by month, transaction_name) as TransactionbyMonth

			Group By month'
		);

    	//reset all month with 0	
    	for ($i=0; $i < 12; $i++) { 
    		$MonthAndValues['series'][]=0;
    	}

    	//fill months with values
    	foreach ($transactionsByMonth as $transactionByMonth) {
    		$MonthAndValues['series'][$transactionByMonth->month-1]=$transactionByMonth->transactions;
    	}

    	$MonthAndValues['labels'] = Lang::get('calendar.shortMonths'); //shortMonths, longMonths, numericMonths
     	$MonthAndValues['legend'] = ['Transactions'];
    	// retrun just the series data to update the graph
   		return $MonthAndValues;
    }

}