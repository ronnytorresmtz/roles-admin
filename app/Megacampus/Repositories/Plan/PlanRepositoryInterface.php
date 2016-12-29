<?php namespace Megacampus\Repositories\Plan;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface PlanRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllPlans($itemsByPage);
	//public function getAllPlans();
	public function getPlanNameByID($id);
	public function getPlanIdByPlanName($moduleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	//public function import($file);
	public function importFile($file);
	
}