<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Institute extends Model {
	 
	use SoftDeletes;

	
	
	protected $table = 'institutes';

	public $timestamps = true;

	protected $dates = ['deleted_at'];  //for SoftDelete

	
	/*public function transactions()
    {
        return $this->hasMany('Transaction');
    }*/
    

	public function getInputRules($form, $request){

		switch ($form) {

			case 'institute.add':
				$rules = array(
						'institute_short_name' => 'required', //|email',
						'institute_long_name'  => 'required' //|numeric'
			     );
				break;

			case 'institute.update':
				$rules = array(
						'institute_short_name' => 'required', //|email',
						'institute_long_name'  => 'required' //|numeric'
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
