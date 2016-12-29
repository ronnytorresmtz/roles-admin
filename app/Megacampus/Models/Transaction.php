<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Transaction extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'transactions';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'transaction.add':
				$rules = array(
						'module_name'        			=> 'required', //|email',
						'transaction_name'        => 'required', //|email',
						'transaction_description' => 'required', //|numeric'
						'transaction_order' 			=> 'required' //|numeric'
			     );
				break;

			case 'transaction.update':
				$rules = array(
						'module_name'        			=> 'required', //|email',
						'transaction_name'        => 'required', //|email',
						'transaction_description' => 'required',//|numeric'
						'transaction_order' 			=> 'required' //|numeric'
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
