<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Language extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'languages';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'language.add':
				$rules = array(
						'language_name'        => 'required', //|email',
						'language_description' => 'required' //|numeric'
			     );
				break;

			case 'language.update':
				$rules = array(
						'language_name'        => 'required', //|email',
						'language_description' => 'required' //|numeric'
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
