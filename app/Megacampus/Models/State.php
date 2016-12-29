<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class State extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'states';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'state.add':
				$rules = array(
						'state_name'        => 'required', //|email',
						'state_description' => 'required' //|numeric'
			     );
				break;

			case 'state.update':
				$rules = array(
						'state_name'        => 'required', //|email',
						'state_description' => 'required' //|numeric'
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
