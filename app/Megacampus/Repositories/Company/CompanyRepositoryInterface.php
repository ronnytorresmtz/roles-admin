<?php namespace Megacampus\Repositories\Company;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface CompanyRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllCompanies();
	public function getCompanyNameByID($id);
	public function getCompanyIdByCompanyName($moduleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($file);
	
}