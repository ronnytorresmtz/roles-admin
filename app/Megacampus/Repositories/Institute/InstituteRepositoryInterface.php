<?php namespace Megacampus\Repositories\Institute;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface InstituteRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllInstitutes();
	public function getInstituteNameByID($id);
	public function getInstituteIdByInstituteName($moduleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file);
	
}