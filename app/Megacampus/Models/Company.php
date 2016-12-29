<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Company extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'companies';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'company.add':
				$rules = array(
						'company_name'        => 'required', //|email',
						'company_description' => 'required' //|numeric'
			     );
				break;

			case 'company.update':
				$rules = array(
						'company_name'        => 'required', //|email',
						'company_description' => 'required' //|numeric'
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
