<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Building extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'buildings';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'building.add':
				$rules = array(
						'building_name'        => 'required', //|email',
						'building_description' => 'required' //|numeric'
			     );
				break;

			case 'building.update':
				$rules = array(
						'building_name'        => 'required', //|email',
						'building_description' => 'required' //|numeric'
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
