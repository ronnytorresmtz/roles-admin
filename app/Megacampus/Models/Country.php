<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Country extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'countries';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'country.add':
				$rules = array(
						'country_name'        => 'required', //|email',
						'country_description' => 'required' //|numeric'
			     );
				break;

			case 'country.update':
				$rules = array(
						'country_name'        => 'required', //|email',
						'country_description' => 'required' //|numeric'
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
