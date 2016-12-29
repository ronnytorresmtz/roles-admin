<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class ucfirstModelTemplate extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'modelTemplates';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	   

	public function getInputRules($form, $request){

		switch ($form) {

			case 'modelTemplate.add':
				$rules = array(
						'modelTemplate_name'        => 'required', //|email',
						'modelTemplate_description' => 'required' //|numeric'
			     );
				break;

			case 'modelTemplate.update':
				$rules = array(
						'modelTemplate_name'        => 'required', //|email',
						'modelTemplate_description' => 'required' //|numeric'
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
