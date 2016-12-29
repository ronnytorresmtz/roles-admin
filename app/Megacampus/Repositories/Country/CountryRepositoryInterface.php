<?php namespace Megacampus\Repositories\Country;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface CountryRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllCountries();
	public function getCountryNameByID($id);
	public function getCountryIdByCountryName($moduleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file);
	
}