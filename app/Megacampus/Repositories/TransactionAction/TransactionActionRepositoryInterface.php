<?php namespace Megacampus\Repositories\TransactionAction;

use Megacampus\Repositories\Eloquent\MyEloquentRepositoryInterface;
 
interface TransactionActionRepositoryInterface extends MyEloquentRepositoryInterface
{
   
	public function getModel();
	public function getAllTransactionActions();
	public function getTransactionActionNameByID($id);
	public function getTransactionActionIdByTransactionActionName($moduleName);
	public function getTransactionsActionsUsedbyDay($request);
	public function getTransactionsActionsUsed($request, $itemsByPage);
   	public function getTransactionsActionsUsedByMonth($request);
}