<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Module extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'modules';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'module.add':
				$rules = array(
						'module_name'        => 'required', //|email',
						'module_description' => 'required', //|numeric'
						'module_order' 			 => 'required' //|numeric'
			     );
				break;

			case 'module.update':
				$rules = array(
						'module_name'        => 'required', //|email',
						'module_description' => 'required', //|numeric'
						'module_order'			 => 'required' //|numeric'
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
