<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class UserActionLog extends Model {
	 
	protected $table = 'users_actions_log';

	public $timestamps = false; //disable

	protected $fillable = array('username', 'module_name', 'transaction_name','action_name');

	
}
