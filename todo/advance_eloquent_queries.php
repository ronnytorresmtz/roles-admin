<?php

 ADVANCE ELOQUENT QUERIES

------
DB::table('mytable')
    ->where('ver', '=', 6)
    ->where('set_id', '=', function($query)
    {
        $query->from('mytable')
              ->select(DB::raw('max(set_id)'))
              ->where('ver', '=', 6);
    })
    ->get();


-----------

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