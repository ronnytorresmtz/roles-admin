<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class RoleTransaction extends Model {

	use SoftDeletes;

	protected $table = 'roles_transactions';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete



	public function getInputRules($form, $request){

		switch ($form) {

			case 'role_transaction.add':
				$rules = array(
						'role_name'					=> 'required',
			            'transaction_name'      	=> 'required', //|email',
			            'transaction_action_name' 	=> 'required' //|numeric'
			     );
				break;

			case 'role_transaction.update':
				$rules = array(
						//'role_name'					=> 'required',
			            //'transaction_name'      	=> 'required', //|email',
			            'transaction_action_name' 	=> 'required' //|numeric'
			     );
				break;
		}		

		return $rules;
	}

	//get the messages for the form validations base on the Language File
	public function getInputMessages($langFileAttributes){
		
		$messages = Lang::get($langFileAttributes);

		return $messages;
	}

}
