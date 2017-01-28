<?php namespace MyCode\Services\AccessRights;


use MyCode\Services\AccessRights\AccessRightsServiceInterface;
use MyCode\Repositories\User\UserRepositoryInterface;
use MyCode\Repositories\Module\ModuleRepositoryInterface;
use MyCode\Repositories\Transaction\TransactionRepositoryInterface;
use MyCode\Repositories\RoleTransaction\RoleTransactionRepositoryInterface;


use Auth;

class AccessRightsService implements AccessRightsServiceInterface
{
	protected $userRepository;
	protected $moduleRepository;
	protected $transactionRepository;
	protected $roleTransactionRepository;

	public function __construct(UserRepositoryInterface $userRepository,
							    ModuleRepositoryInterface $moduleRepository,
							    TransactionRepositoryInterface $transactionRepository,
							    RoleTransactionRepositoryInterface  $roleTransactionRepository)
	{
		$this->userRepository            = $userRepository;
		$this->moduleRepository          = $moduleRepository;
		$this->transactionRepository     = $transactionRepository;
		$this->roleTransactionRepository = $roleTransactionRepository;
	}


	public function hasAccessToModule($moduleName)
	{
		$roleId   = $this->userRepository->find(Auth::user()->id)->role_id;
		$moduleId = $this->moduleRepository ->getModuleIdByModuleName($moduleName);
		
		return $this->roleTransactionRepository->existRoleWithModule($roleId, $moduleId);

	}


	public function hasAccessToModuleTransactionForAction($module, $transaction, $action)
	{
		
		$roleId        = $this->userRepository->find(Auth::user()->id)->pluck('role_id');
		$moduleId      = $this->moduleRepository->getModuleIdByModuleName($module);
		$transactionId = $this->transactionRepository->getTransactionIdByTransactionName($transaction);

		return true;

	}


}