<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Role extends Model {

	use SoftDeletes;
	
	protected $table = 'Roles';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete


	public function transactions()
	{

		return $this->belongsToMany('Transaction', 'roles_transactions', 'role_id', 'transaction_id')
					->withPivot('role_transaction_action_id');

	}


	public function getInputRules($form, $request)
	{

		switch ($form) {

			case 'role.add':
				$rules = array(
			            'role_name'      	=> 'required', //|email',
			            'role_description' 	=> 'required' //|numeric'
			     );
				break;

			case 'role.update':
				$rules = array(
			            'role_name'      	=> 'required', //|email',
			            'role_description' 	=> 'required' //|numeric'
			     );
				break;
		}		

		return $rules;
	}

	//get the messages for the form validations base on the Language File
	public function getInputMessages($langFileAttributes)
	{
		
		$messages = Lang::get($langFileAttributes);

		return $messages;
	}



}
