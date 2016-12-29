<?php namespace Megacampus\Repositories\State;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface StateRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllStatesByPage($itemsByPage);
	public function getAllStates();
	public function getStateNameByID($id);
	//public function getStatesByCountryName($countryName, $itemsByPage);
	public function findState($request);
	public function getStatesByCountryIdByPage($id, $itemsByPage);
	public function getStatesByCountryId($id);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file, $countryID);
	
}