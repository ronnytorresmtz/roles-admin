<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Campus extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'campuss';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'campus.add':
				$rules = array(
						'campus_name'        => 'required', //|email',
						'campus_description' => 'required' //|numeric'
			     );
				break;

			case 'campus.update':
				$rules = array(
						'campus_name'        => 'required', //|email',
						'campus_description' => 'required' //|numeric'
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
