<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Configuration extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'configurations';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'configuration.add':
				$rules = array(
						'configuration_name'        => 'required', //|email',
						'configuration_description' => 'required' //|numeric'
			     );
				break;

			case 'configuration.update':
				$rules = array(
						'configuration_name'        => 'required', //|email',
						'configuration_description' => 'required' //|numeric'
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
