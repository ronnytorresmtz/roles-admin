<?php 

// app/models/Plan.php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Plan extends Model {

	use SoftDeletes;

	protected $table = 'plans';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	//protected $hidden = array('field','field','field');

	public function getInputRules($form, $request){

		switch ($form) {

			case 'plan.add':
				$rules = array(
			            'plan_id'      	 	=> 'required',
			            'plan_name'      	=> 'required', //|email',
			            'plan_description' 	=> 'required' //|numeric'
			     );
				break;

			case 'plan.update':
				$rules = array(
			            'plan_id'      	 	=> 'required',
			            'plan_name'      	=> 'required', //|email',
			            'plan_description' 	=> 'required' //|numeric'
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
