<?php

/**
 * Controller Name: UserController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Users Information
 * 
 * Author: 
 *<203></203>
  */

use Illuminate\Http\Request;
use App\Events\RegisterTransactionAccessEvent;
use MyCode\Repositories\User\UserRepositoryInterface;
use MyCode\Repositories\Role\RoleRepositoryInterface;
use MyCode\Services\Validation\ValidationServiceInterface;
use MyCode\Services\Document\DocumentServiceInterface;


class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $userRepository;
	protected $validationService;
	protected $documentService;
	protected $roleRepository;

	private $directory_files = "security/users";

	private $itemsByPage = 10;



	public function __construct(UserRepositoryInterface $userRepository,
								RoleRepositoryInterface $roleRepository,
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService)
	{
		$this->userRepository    = $userRepository;
		$this->validationService = $validationService;
		$this->documentService   = $documentService;
		$this->roleRepository    = $roleRepository;
	}


	public function index()
	{

		$users=$this->userRepository->getAllUsersByPage($this->itemsByPage);

		Event::fire(new RegisterTransactionAccessEvent('security.users.index'));

	  return response()->json($users);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */	
	public function store(Request $request)
	{
		$result = [];
		//persist input data from a form request
		$request->flash();
		// validate the fields base on the rules define
		$result=$this->validationService->validateInputs($this->userRepository->getModel(), $request->all(), 'AddUserForm', 'validation.users');
       
   		if (! $result['error']){

			$result = $this->userRepository->store($request);

			if (! $result['error']){
			
				Event::fire(new RegisterTransactionAccessEvent('security.users.store'));

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

		//persist input data from a form request
		$request->flash();
		// validate the fields base on the rules define
		$result=$this->validationService->validateInputs($this->userRepository->getModel(), $request->all(), 'UpdateUserForm', 'validation.users');

    if (! $result['error']){
      // update the data to the database
      $result=$this->userRepository->update($id, $request);

		 	if (! $result['error']){

		 		Event::fire(new RegisterTransactionAccessEvent('security.users.update'));

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
		$result=$this->userRepository->delete($id);

  	if (! $result['error']){

  		Event::fire(new RegisterTransactionAccessEvent('security.users.delete'));	

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
		//get all the users found with the filter applied	
		$users=$this->userRepository->search($value, $this->itemsByPage);
		//set a color tag with the fileter
		//$label_search= $value;
		Event::fire(new RegisterTransactionAccessEvent('security.users.search'));
		//make the view and return the item filtered
		return response()->json($users);
    	
	}

	/**
	 * Export all transactionas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data= $this->userRepository->getAllUsers();
		
		if ($this->documentService->export($data, 'csv', 'User')){
			
			Event::fire(new RegisterTransactionAccessEvent('security.users.export'));
		}
		
		return redirect()->back();
	}


	public function postImport(Request $request) 
	{ 

		$file= $this->validationService->getFile($request, true);
		//validate the request if file is missing send an error to user
		if (isset($file)) {

			if ($this->userRepository->import($this->roleRepository, $file)){

				Event::fire(new RegisterTransactionAccessEvent('security.users.import'));
			}
		}
		//Redirect to the import page
	   	return redirect()->to(URL::route('security.users.import_file'));
	}

 

	public function postSendTokenToResetPassoword(Request $request)	
	{

		$checked_items= $this->validationService->getAllIdChecked($request, true);	

		if ($checked_items !== 0){

			foreach ($checked_items as $userId ) {

				$user=$this->userRepository->find($userId);

				if (!$this->userRepository->sendTokenToUserViaMail($user)){

					Event::fire(new RegisterTransactionAccessEvent('security.users.sendTokenToResetPassword'));

					Session::flash('error', Lang::get('messages.error_password_sent' ) . ' - ' . $user->user_fullname);
				}

			}
		}

		return redirect()->route('security.users.index');
	}


    public function postSecurityUsersLoggedByDay(Request $request)
    {
     	Event::fire(new RegisterTransactionAccessEvent('security.dashboard.users'));
    	$usersLoggedByDay= $this->userRepository->getUsersLoggedbyDay($request);

    	return response()->json($usersLoggedByDay);
    }


    public function getSecurityUsersLogged(Request $request)
    {
    	$usersLogged = $this->userRepository->getUsersLogged($request, $this->itemsByPage);
      	
      	return response()->json($usersLogged);
    }


     public function getSecurityActionsByUsersLogged(Request $request)
    {
    	$usersLogged = $this->userRepository->getActionsByUsersLogged($request, $this->itemsByPage);
      	
	    return response()->json($usersLogged);
    }


    public function postSecurityUsersLoggedByMonth(Request $request)
    {
    	$usersLoggedByMonth = $this->userRepository->getUsersLoggedbyMonth($request);

    	return response()->json($usersLoggedByMonth);
    }

}	