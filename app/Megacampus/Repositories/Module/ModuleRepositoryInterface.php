<?php namespace Megacampus\Repositories\Module;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface ModuleRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllModules($itemsByPage);
	public function getAllModulesActive($itemsByPage = null);
	public function getModuleByID($id);
	public function getModuleIDByModuleName($roleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function importFile($file);
	public function getModulesUsedbyDay($request);
	public function getModulesUsed($request, $itemsByPage);
	public function getModulesUsedByMonth($request);
	
}