<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class City extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'cities';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'city.add':
				$rules = array(
						'city_name'        => 'required', //|email',
						'city_description' => 'required' //|numeric'
			     );
				break;

			case 'city.update':
				$rules = array(
						'city_name'        => 'required', //|email',
						'city_description' => 'required' //|numeric'
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
