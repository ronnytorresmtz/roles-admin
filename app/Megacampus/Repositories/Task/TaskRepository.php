<?php namespace Megacampus\Repositories\Task;
 
use Carbon\Carbon;
use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
//use Megacampus\Repositories\Task\TaskRepositoryInterface;


use Exception, Lang, Task, TaskLog;
 
class TaskRepository extends MyAbstractEloquentRepository implements TaskRepositoryInterface  
{
 
	// Properties

	protected $model;
	protected $taskLog;

	 
	//Constructor
	   
	public function __construct(Task $model, TaskLog $taskLog) 
	{
		$this->model   = $model; 
		$this->taskLog = $taskLog;
	}


	public function getModel()
	{
	
		return  $this->model;
	}


	public function search($value, $itemsByPage=50)
	{

		// find the string in the database and return the modules found
		return 	$this->model->where('id','like','%' . $value . '%')
							->orwhere('task_name','like','%' . $value . '%')
							->orwhere('task_description','like','%' . $value . '%')
							->orwhere('task_command_execution_result','like','%' . $value . '%')
						
							->paginate($itemsByPage);
	}


	public function executeCommand($request){

		if ($request->ajax()){

			$jsondata = array();

			$checkitem=$request->input('checked_items');

			$task=$this->model->find($checkitem[0]);

			try{
				$result= \Artisan::call($task->task_command);

				$messageType=Lang::get('labels.task_successed');
				// response ajax
				$jsondata=$this->saveTaskStatus($task, $messageType);
				//define the message to store in the task log table in the database	
				$message=Lang::get('messages.success');
				//save in database
				$this->saveTaskLog($task->id, $messageType, $message);
				
				return $jsondata;

			} catch (Exception $e){
				$messageType=Lang::get('labels.task_failed');
				// response ajax			
				$jsondata=$this->saveTaskStatus($task, $messageType);
				//define the message to store in the task log table in the database
				$message= Lang::get('messages.error_caught_exception') . ' ' . str_replace("'"," ", $e->getMessage());
				//save in database				
				$this->saveTaskLog($task->id, $messageType, $message);

				return $jsondata;
			}
		}


	}

	public function saveTaskStatus($task,$status){	

		$jsondata = array();
		
		//jsondata to return
		$jsondata['status']         = $status;
		$jsondata['execution_date'] = Carbon::now();
		//store result in the database
		$task->task_command_execution_result = $jsondata['status'];
		$task->updated_at                    = $jsondata['execution_date'];
		$task->update();

		return $jsondata;

	}


	public function getTaskLogbyId($id)
	{

		return 	$this->taskLog->select(

			'tasks_log.created_at',
			'tasks.task_name',
			'tasks_log.task_log_message_type',
			'tasks_log.task_log_message'

		)->join('tasks', 'tasks_log.task_log_id',' =', 'tasks.id')
			->where('task_log_id','=', $id)
			->orderBy('created_at', 'desc')
			->paginate(10);
	}

	
	public function saveTaskLog($taskId, $messageType, $message){

		// Record the task id and message in the task table
		$this->taskLog->create(array(
			'task_log_id'           => $taskId, 
			'task_log_message_type' => $messageType, 
			'task_log_message'      => $message
		));

		return true;
	}

}