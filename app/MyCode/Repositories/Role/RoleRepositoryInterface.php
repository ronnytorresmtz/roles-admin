<?php namespace MyCode\Repositories\Role;

use MyCode\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface RoleRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllRoles($itemsByPage);
	public function getAllRolesActive($itemsByPage = null);
	public function getRoleByID($id);
	public function getRoleIDByRoleName($roleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	//public function import($file);
	public function importFile($file);
	
}