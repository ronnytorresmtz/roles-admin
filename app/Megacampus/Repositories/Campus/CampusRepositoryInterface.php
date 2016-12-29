<?php namespace Megacampus\Repositories\Campus;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface CampusRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllCampuss();
	public function getCampusNameByID($id);
	public function getCampusIdByCampusName($moduleName);
	public function findCampus($request);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file, $instituteID);
	
}