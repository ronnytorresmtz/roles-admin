<?php namespace Megacampus\Repositories\Transaction;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface TransactionRepositoryInterface extends MyEloquentRepositoryInterface
{

	public function getModel();
	public function getAllTransactionsByPage($itemsByPage);
	public function getAllTransactionsActiveByPage($itemsByPage);
	public function getAllTransactions();
	public function getAllTransactionsByModuleId($moduleId);
	public function getAllTransactionsByModuleName($moduleName);
	public function getTransactionIdByTransactionName($transactionName);
	public function store($request);
	public function update($id, $request);
	public function delete($id);
	public function search($value, $itemsByPage);
	public function import($moduleRepository, $file);
	public function getChartAmountTransactionsUsedByDay($request, $month, $year);
	public function getChartAmountTransactionsUsedByMonth($request, $year);
	public function getTransactionsUsed($month, $year);
	
}