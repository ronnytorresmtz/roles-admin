<?php

/**
 * Controller Name: RoleController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Roles Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use MyCode\Repositories\Role\RoleRepositoryInterface as RoleRepositoryInterface;
use MyCode\Services\Url\UrlServiceInterface as UrlServiceInterface;
use MyCode\Services\Validation\ValidationServiceInterface as ValidationServiceInterface;
use MyCode\Services\Document\DocumentServiceInterface as DocumentServiceInterface;


class RoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $roleRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;

	private $baseRoute = 'security.roles';

	private $itemsByPage = 100;



	public function __construct(RoleRepositoryInterface $roleRepository,
															UrlServiceInterface $urlService, 
															ValidationServiceInterface $validationService,
															DocumentServiceInterface $documentService)
	{
		$this->roleRepository    = $roleRepository;
		$this->urlService        = $urlService;
		$this->validationService = $validationService;
		$this->documentService   = $documentService;
	}


	public function index()
	{

		$roles=$this->roleRepository->getAllRoles($this->itemsByPage);

		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.index'));

		return response()->json($roles);

	}

	public function getAllRolesActive()
	{
		
		$roles=$this->roleRepository->getAllRolesActive(null);

	  	return response()->json($roles);
	}


	public function getAllRolesActivebyPage()
	{
		
		$roles=$this->roleRepository->getAllRolesActive($this->itemsByPage);

	  	return response()->json($roles);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */	
	public function store(Request $request)
	{
		$result = [];
		// validate the fields base on the rules define
		$result=$this->validationService->validateInputs($this->roleRepository->getModel(), $request->all(), 'role.add', 'validation.roles');
		// Send to view the errros messages and the input data
		if (! $result['error']){

			$result = $this->roleRepository->store($request);

			if (! $result['error']){
			
				Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . 'store'));

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
		$result=$this->validationService->validateInputs($this->roleRepository->getModel(), $request->all(), 'role.update', 'validation.roles');
      // Send to view the errors messages
		if (! $result['error']){
		// update the data to the database
    	$result=$this->roleRepository->update($id, $request);

		 	if (! $result['error']){

		 		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.update'));

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
		// delete the $id in the database
		$result=$this->roleRepository->delete($id);

		if (! $result['error']){

			Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.delete'));		

			return response()->json($result);
		}

	 	return response()->json($result);
	}

	/**
	 * Search a string input by the user.
	 *
	 * @return Response
	 */
	public function getSearch(Request $request) 
	{
		$value= $request->input('searchText');
		//get all the roles found with the filter applied	
		$roles=$this->roleRepository->search($value, $this->itemsByPage);
		//set a color tag with the fileter
		//$label_search= $value;
		Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.search'));
		//make the view and return the item filtered
		return response()->json($roles);
    	
	}

	/**
	 * Export all roleas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data= $this->roleRepository->getModel()->all();

		$result=$this->documentService->export($data, 'csv', 'Role');

		if (! $result['error']){

			Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.export'));

			return response()->json($result); 
		}

		return response()->json($result); 
	}



	
	public function postImport(Request $request) 
	{ 

		$result=[];

		$file=json_decode($request->input('values'), true);
		//validate the request if file is missing send an error to user
		if (! empty($file)) {
			
			$result=$this->roleRepository->importFile($file);

			if (! $result['error']){

				Event::fire(new RegisterTransactionAccessEvent($this->baseRoute . '.import'));

				return response()->json($result);
			}

		}
		
		return response()->json($result);
	}

}	