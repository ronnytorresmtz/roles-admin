<?php namespace Megacampus\Repositories\Task;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface TaskRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function executeCommand($request);
	public function search($value, $itemsByPage=50);
	public function getTaskLogbyId($id);
	public function saveTaskLog($taskId, $messageType, $message);
	
}