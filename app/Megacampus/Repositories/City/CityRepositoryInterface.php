<?php namespace Megacampus\Repositories\City;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface CityRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllCitiesByPage($countryid, $stateId, $itemsByPage);
	public function getAllCities($countryId, $stateId);
	public function getCityNameByID($id);
	public function getCitiesbyStateNameByPage($stateName, $countryId, $itemsByPage);
	public function getCitiesByStateIdByPage($id, $itemsByPage);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	//public function search($value, $itemsByPage);
	public function import($file, $stateID);
	
}