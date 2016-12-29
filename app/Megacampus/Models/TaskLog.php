<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class TaskLog extends Model {
	 
	protected $table = 'tasks_log';

	public $timestamps = true; //disable

	protected $fillable = array('task_log_id', 'task_log_message_type','task_log_message');
	
}
