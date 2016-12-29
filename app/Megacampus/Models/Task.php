<?php 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Task extends Model {
	 
	protected $table = 'tasks';

	public $timestamps = true; //disable

	protected $fillable = array('task_name', 'task_description', 'task_status');

	
}
