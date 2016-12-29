<?php 

// app/models/Program.php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Program extends Model {

	use SoftDeletes;

	protected $table = 'programs';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	//protected $hidden = array('field','field','field');

	public function getInputRules($form, $request){

		switch ($form) {

			case 'program.add':
				$rules = array(
			            'program_id'      	 	=> 'required',
			            'program_name'      	=> 'required', //|email',
			            'program_description' 	=> 'required' //|numeric'
			     );
				break;

			case 'program.update':
				$rules = array(
			            'program_id'      	 	=> 'required',
			            'program_name'      	=> 'required', //|email',
			            'program_description' 	=> 'required' //|numeric'
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
