<?php

/**
 * Controller Name: RoleTransactionController
 *
 * Description: Controller to list, insert, update, delete, search, export and import RoleTransactions Information
 * 
 * Author: 
 * <203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use MyCode\Repositories\RoleTransaction\RoleTransactionRepositoryInterface;
use MyCode\Repositories\Role\RoleRepositoryInterface;
use MyCode\Repositories\Transaction\TransactionRepositoryInterface;
use MyCode\Repositories\TransactionAction\TransactionActionRepositoryInterface;
use MyCode\Repositories\Module\ModuleRepositoryInterface;
use MyCode\Services\Validation\ValidationServiceInterface;
use MyCode\Services\Document\DocumentServiceInterface;



class RoleTransactionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $roleTransactionRepository;
	protected $roleRepository;
	protected $moduleRepository;
	protected $transactionRepository;
	protected $transactionActionRepository;
	protected $documentService;

	private $directory_files = "security/roles_transactions";

	private $itemsByPage = 10;


	public function __construct(RoleTransactionRepositoryInterface $roleTransactionRepository,
															RoleRepositoryInterface $roleRepository,
															ModuleRepositoryInterface $moduleRepository,
															TransactionRepositoryInterface $transactionRepository,
															TransactionActionRepositoryInterface $transactionActionRepository,
															ValidationServiceInterface $validationService,
															DocumentServiceInterface $documentService)
	{
		$this->roleTransactionRepository   = $roleTransactionRepository;
		$this->roleRepository              = $roleRepository;
		$this->moduleRepository            = $moduleRepository;
		$this->transactionRepository       = $transactionRepository;
		$this->transactionActionRepository = $transactionActionRepository;
		$this->validationService           = $validationService;
		$this->documentService             = $documentService;
		
	}

	/**
	 * List the specified resource from storage
	 *
	 * @return Response
	 */	

	public function index()
	{

		$roles_transactions = $this->roleTransactionRepository->getTransactionByRole(1, $this->itemsByPage);

		Event::fire(new RegisterTransactionAccessEvent('security.rolesTransactions.view'));

	  return response()->json($roles_transactions);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */	
	public function store(Request $request)
	{
		
		// validate the fields base on the rules define
		$result=$this->validationService->validateInputs($this->roleTransactionRepository->getModel(), $request->all(), 'role_transaction.add', 'validation.roles_transactions');
		// Send to view the errros messages and the input data
		 if (! $result['error']){

			$result= $this->roleTransactionRepository->store($request);
						
			if (! $result['error']){

		 		Event::fire(new RegisterTransactionAccessEvent('security.rolesTransactions.store'));

		 		return response()->json($result);
			 }

		} 			

		return response()->json($result);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		// validate the fields base on the rules define
		$result=$this->validationService->validateInputs($this->roleTransactionRepository->getModel(), $request->all(), 'role_transaction.update', 'validation.roles_transactions');

    if (! $result['error']){

      $result=$this->roleTransactionRepository->update($id, $request);

		 	if (! $result['error']){

		 		Event::fire(new RegisterTransactionAccessEvent('security.rolesTransactions.update'));

		 		return response()->json($result);
		 	}

	 	}

		return response()->json($result);

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
		 */
	public function destroy($id)
	{
  	$result = $this->roleTransactionRepository->delete($id);

		if (! $result['error']){

  		Event::fire(new RegisterTransactionAccessEvent('security.rolesTransactions.delete'));

  		return response()->json($result);
  	}

  	return response()->json($result);
	}

	/**
	 * Export all transactionas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 
		$data= $this->roleTransactionRepository->getAllRolesTransactions();

		if ($this->documentService->export($data, 'csv', 'RoleTransaction')){

			Event::fire(new RegisterTransactionAccessEvent('security.rolesTransactions.export'));
		}

		return redirect()->back();
	}


	public function getSelectImportFile() 
	{ 

		$this->urlService->getUrlPrevious($this->directory_files);

    return View::make($this->directory_files .'/import');
	}

	
	public function postImport(Request $request) 
	{ 

		$file= $this->validationService->getFile($request, true);
		//validate the request if file is missing send an error to user
		if (isset($file)) {

			if ($this->roleTransactionRepository->import($this->roleRepository, $file)){
				
				Event::fire(new RegisterTransactionAccessEvent('security.rolesTransactions.import'));
			}

		}
		//Redirect to the import page
   	return redirect()->to(URL::route('security.roles_transactions.import_file'));
	}


	public function getRoleSelected($roleSelected)
	{
	
		$roles_transactions=$this->roleTransactionRepository->getTransactionByRole($roleSelected, $this->itemsByPage);

		return response()->json($roles_transactions);
	}


	public function getTransactionsByModuleSelected($moduleSelected, Request $request)
	{

		return $this->transactionRepository->getAllTransactionsByModuleId($moduleSelected);

		
	}


	public function getTransactionActionsByTransactionSelected()
	{

		$actions = $this->transactionActionRepository->getAllTransactionActions();
		
		return response()->json($actions);
	  	
	}

}	