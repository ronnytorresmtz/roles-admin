<?php namespace MyCode\Repositories\RoleTransaction;

use MyCode\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface RoleTransactionRepositoryInterface extends MyEloquentRepositoryInterface
{

	public function getModel();
	public function getAllRolesTransactionsByPage($itemsByPage);
	public function getAllRolesTransactions();
	public function getRoleTransactionNameByID($id);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	// public function search($value, $itemsByPage);
	public function import($moduleRepository, $file);
	public function getModulesByRoleId($roleId);
	public function getTransactionsByRoleIdAndModuleName($roleId, $moduleName);
	public function getTransactionsActionIdByRoleIdAndModuleName($roleId, $moduleName, $transactionName);
	
	
}