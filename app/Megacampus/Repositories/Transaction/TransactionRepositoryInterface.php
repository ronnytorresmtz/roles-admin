<?php namespace Megacampus\Repositories\Transaction;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface TransactionRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllTransactions($itemsByPage);
	public function getAllTransactionsActive($itemsByPage = null);
	public function getAllTransactionsByModuleId($moduleId);
	public function getAllTransactionsByModuleName($moduleName);
	public function getTransactionByID($id);
	public function getTransactionIDByTransactionName($roleName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function importFile($file);
	public function getTransactionsUsedbyDay($request);
	public function getTransactionsUsed($request, $itemsByPage);
	public function getTransactionsUsedbyMonth($request);
}