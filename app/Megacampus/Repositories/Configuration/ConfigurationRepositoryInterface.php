<?php namespace Megacampus\Repositories\Configuration;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface ConfigurationRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllConfigurations();
	public function getConfigurationNameByID($id);
	public function getConfigurationIdByConfigurationName($moduleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file);
	
}