<?php namespace MyCode\Repositories\RoleTransaction;
 
use MyCode\Repositories\Eloquent\MyAbstractEloquentRepository;
use MyCode\Repositories\RoleTransaction\RoleTransactionRepositoryInterface;

use  DB, Exception, Lang, RoleTransaction, Session;
 
class RoleTransactionRepository extends MyAbstractEloquentRepository implements RoleTransactionRepositoryInterface 
{
 
	// Properties

	protected $model;
	 
	//Constructor
	   
	public function __construct(RoleTransaction $model) 
	{
		$this->model = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}


	public function getAllRolesTransactionsByPage($itemsByPage)
	{

		$roles_transactions= $this->model->select(
				'roles_transactions.id',
				'roles.role_name', 
				'modules.module_name',
				'transactions.transaction_name', 
				'transactions.transaction_description',
				'roles_transactions.transaction_action_id',
				'transaction_actions.transaction_action_name',
				'roles_transactions.created_at',
				'roles_transactions.updated_at')

            ->join('roles', 'roles_transactions.role_id', '=', 'roles.id')
            ->join('transactions', 'roles_transactions.transaction_id', '=', 'transactions.id')
            ->join('transaction_actions', 'roles_transactions.transaction_action_id', '=', 'transaction_actions.id' )
			->leftjoin('modules','transactions.module_id' ,'=', 'modules.id')

			->orderby('roles.role_name', 'ASC')
			->orderby('modules.module_name', 'ASC')
			->orderby('transactions.transaction_name', 'ASC')
           
      ->paginate($itemsByPage);

			return $roles_transactions;

	}


	public function getAllRolesTransactions()
	{
		
    $roles_transactions = $this->model->select(
		'roles_transactions.id',
		'roles.role_name',
		'modules.module_name', 
		'transactions.transaction_name', 
		'transactions.transaction_description',
		'transaction_actions.transaction_action_name',
		'roles_transactions.created_at',
		'roles_transactions.updated_at')
    
		->join('roles', 'roles_transactions.role_id', '=', 'roles.id')
		->join('transactions', 'roles_transactions.transaction_id', '=', 'transactions.id')
		->join('transaction_actions', 'roles_transactions.transaction_action_id', '=', 'transaction_actions.id' )
		->leftjoin('modules','transactions.module_id', '=', 'modules.id')

		->orderby('roles.role_name', 'ASC')
		->orderby('modules.module_name', 'ASC')
		->orderby('transactions.transaction_name', 'ASC')

	  ->get();

		return $roles_transactions;
	}



	public function getRoleTransactionNameByID($id)
	{

	$role_transaction= $this->model->select(
		'roles_transactions.id',
		'roles.id as role_id', 
		'roles.role_name', 
		'modules.module_name',
		'transactions.transaction_name', 
		'transactions.transaction_description',
		'roles_transactions.transaction_action_id',
		'transaction_actions.transaction_action_name',
		'roles_transactions.created_at',
		'roles_transactions.updated_at')

		->join('roles', 'roles_transactions.role_id', '=', 'roles.id')
		->join('transactions', 'roles_transactions.transaction_id', '=', 'transactions.id')
		->join('transaction_actions', 'roles_transactions.transaction_action_id', '=', 'transaction_actions.id' )
		->leftjoin('modules','transactions.module_id', '=', 'modules.id')

		->where('roles_transactions.id', '=', $id)

		->orderby('roles.role_name', 'ASC')
		->orderby('modules.module_name', 'ASC')
		->orderby('transactions.transaction_name', 'ASC')

    ->get();

		return $role_transaction;
	}

	public function getTransactionByRole($id, $itemsByPage)
	{

		$role_transaction=  $this->model->select(
		'roles_transactions.id',
		'roles.role_name', 
		'modules.module_name',
		'transactions.transaction_name', 
		'transactions.transaction_description',
		'transaction_actions.transaction_action_name',
		'roles_transactions.created_at',
		'roles_transactions.updated_at')

		->join('roles', 'roles_transactions.role_id', '=', 'roles.id')
		->join('transactions', 'roles_transactions.transaction_id', '=', 'transactions.id')
		->join('transaction_actions', 'roles_transactions.transaction_action_id', '=', 'transaction_actions.id' )
		->leftjoin('modules','transactions.module_id', '=', 'modules.id')

		->where('roles_transactions.role_id', '=', $id)

		->orderby('modules.module_name', 'ASC')
		->orderby('transactions.transaction_name', 'ASC')

		->paginate($itemsByPage);

		return $role_transaction;
	}

	public function getModulesByRoleId($roleId)
	{
		
		$modulesNames=  $this->model->select('modules.module_name')

		->join('modules','roles_transactions.module_id', '=', 'modules.id')

		->where('roles_transactions.role_id', '=', $roleId)
		->where('roles_transactions.transaction_action_id', '<>', 1) //No Access Allowed=1

		->orderBy('modules.module_order')
		->groupBy('modules.module_name')

		->get();

		return $modulesNames;
	}

	public function roleHastAccessToAnyModule($roleId)
	{
		
		$modulesNames=  $this->model->select('*')

		->where('roles_transactions.role_id', '=', $roleId)
		->where('roles_transactions.transaction_action_id', '<>', 1) //No Access Allowed=1

		->first();

		return ((count($modulesNames)==0) ? false : true);
	}


	public function getTransactionsByRoleIdAndModuleName($roleId, $moduleName)
	{
		
		$transaction_names=  $this->model->select(
			'transactions.transaction_name', 
			'modules.module_name'
		)

		->join('transactions', 'roles_transactions.transaction_id', '=', 'transactions.id')
		->join('modules','roles_transactions.module_id', '=', 'modules.id')

		->where('roles_transactions.role_id', '=', $roleId)
		->where('modules.module_name', '=', $moduleName)
		->where('roles_transactions.transaction_action_id', '<>', 1) //No Access Allowed=1

		->orderby('transactions.transaction_order', 'ASC')

		->get();

		return $transaction_names;

	}

	public function getTransactionsActionIdByRoleIdAndModuleName($roleId, $moduleName, $transactionName)
	{
		
		$transactionActionId=  $this->model->select('roles_transactions.transaction_action_id')

		->join('transactions', 'roles_transactions.transaction_id', '=', 'transactions.id')
		->join('modules','roles_transactions.module_id', '=', 'modules.id')

		->where('roles_transactions.role_id', '=', $roleId)
		->where('modules.module_name', '=', $moduleName)
		->where('transactions.transaction_name', '=', $transactionName)

		->first();

		return $transactionActionId;
	}
	

	public function store($request)
	{
		// find if exist the role_name and transaction_name contains in the request
		$role_transaction=$this->findRoleTransaction($request);
		
		// update because the role_transaction exist
		if ($role_transaction->count()>0){

			if (! $this->update($role_transaction[0]->id, $request)){
			 	
			 	return array('error' => true, 'message' => Lang::get('messages.error'));
			}

		} else {
			// add the role_transaction to the database
			if (! $this->save($request)){
			 	
			 	return array('error' => true, 'message' => Lang::get('messages.error'));
			}
		}

		return array('error' => false, 'message' => Lang::get('messages.success'));
	}


	public function findRoleTransaction($request)
	{

		$role_transaction=$this->model->select('id','transaction_action_id')

		->where('role_id','=', $request->input('role_name'))
		->where('transaction_id','=', $request->input('transaction_name'))
		
		->get();

		return $role_transaction;

	}


	public function save($request)
	{

		try{
			$model                        = new $this->model;		
			
			$model->role_id               = $request->input('role_name');
			$model->module_id             = $request->input('module_name');
			$model->transaction_id        = $request->input('transaction_name');
			$model->transaction_action_id = $request->input('transaction_action_name');
			
			$model->touch();
			
			if (! $model->update()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e){

			return  array('error' => true, 'message' =>  Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
			
		}

	}


	public function update($id, $request)
	{

		try{
			// store the data to the database
			$model = $this->model->find($id);

			$model->role_id               = $request->input('role_name');
			$model->module_id             = $request->input('module_name');
			$model->transaction_id        = $request->input('transaction_name');
			$model->transaction_action_id = $request->input('transaction_action_name');
			
			$model->touch();
			
			if (! $model->update()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e){

			return  array('error' => true, 'message' =>  Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
			
		}

	}


	public function delete($id)
	{
		try{
			// find a transaction id to delete it
			$model = $this->model->find($id);

			if (! $model->delete()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e){

			return  array('error' => true, 'message' =>  Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
			
		}

	}


	/*public function search($value, $itemsByPage)
	{

	$roles_transactions=$this->model->select(
			'roles_transactions.id',
			'roles.role_name', 
			'modules.module_name',
			'transactions.transaction_name', 
			'transactions.transaction_description',
			'roles_transactions.transaction_action_id',
			'transaction_actions.transaction_action_name',
			'roles_transactions.created_at',
			'roles_transactions.updated_at')

        ->join('roles', 'roles_transactions.role_id', '=', 'roles.id')
        ->join('transactions', 'roles_transactions.transaction_id', '=', 'transactions.id')
        ->join('transaction_actions', 'roles_transactions.transaction_action_id', '=', 'transaction_actions.id' )
        ->leftjoin('modules','transactions.module_id', '=', 'modules.id')

		->where('roles.role_name','like','%' . $value . '%')
		->where(function ($query) use ($value)
			{
				$query->orwhere('transactions.transaction_name','like','%' . $value . '%')
				  	  ->orwhere('transactions.transaction_description','like','%' . $value . '%')
				  	  ->orwhere('transaction_actions.transaction_action_name','like','%' . $value . '%');
		 	})

		->orderby('roles.role_name', 'ASC')
		->orderby('modules.module_name', 'ASC')
		->orderby('transactions.transaction_name', 'ASC')


	 	->paginate($itemsByPage);

	return $roles_transactions;

	}*/


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
				$i=0; // count add records
				$j=0; // count update records

				$transactionActions = \TransactionAction::select('id','transaction_action_name')->get()->all();

				foreach ($results as $key => $row)  {
					// Validate if the file uploaded has the ID field
					if (isset($row)) {
						// find the id to decide if it wil be an update or add process
						$rowId= $this->model->find($row->id);
						//validate if $id was found so UPDATE it
						if ($rowId) {
							
							switch ($row->transaction_action_name) {
								case $transactionActions[0]->transaction_action_name: 
									$transactionActionNameID=1; 
									break;
										
								case $transactionActions[1]->transaction_action_name: 
									$transactionActionNameID=2; 
									break;
								
								case $transactionActions[2]->transaction_action_name: 
									$transactionActionNameID=3; 
									break;

								default:
									$transactionActionNameID=null;
    						}
							
							if (! isset($transactionActionNameID)){
								
								Session::flash('error', Lang::get('messages.error_transaction_action_name') . $row->transaction_action_name);

								return false;

							} else {

								$rowId->transaction_action_id = $transactionActionNameID;
								$rowId->touch();  			//touch: update timestamps
								$rowId->save();
								$j++;
							}
						}
						// validate no found so ADD it
						//} else {}
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

}