<?php

/**
 * Controller Name: StateController
 *
 * Description: Controller to list, insert, update, delete, search, export and import States Information
 * 
 * Author: 
 *<203></203>
 *
  */
 
 //Keys_template: state, states, State, ucfisrtModelTemplates
 //Keys_template: country, countries, Country, ucfisrtSelectTemplates

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\State\StateRepositoryInterface;
use Megacampus\Repositories\Country\CountryRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface as UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface as ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface as DocumentServiceInterface;
use Megacampus\Services\General\GeneralServiceInterface as GeneralServiceInterface;

//use Request;

class StateController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $stateRepository;
	protected $countryRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;
	protected $generalService;

	private $directory_files = "data/states";

	private $itemsByPage = 100;



	public function __construct(StateRepositoryInterface $stateRepository,
								CountryRepositoryInterface $countryRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService,
								GeneralServiceInterface $generalService)
	{
		$this->stateRepository   = $stateRepository;
		$this->countryRepository = $countryRepository;
		$this->urlService        = $urlService;
		$this->validationService = $validationService;
		$this->documentService   = $documentService;
		$this->generalService    = $generalService;
	}


	public function index()
	{
		$this->urlService->forgetUrlPrevious();

		Event::fire(new RegisterTransactionAccessEvent('data.states.index'));

	  	return View::make($this->directory_files .'/list')
			->with(
				array(
					'countries_names' => $this->generalService->setKeyAndNameToArray($this->countryRepository->getAllCountries(), 'country_name'),
					'states'          => $this->stateRepository->getStatesByCountryIdByPage(1, $this->itemsByPage),
					'create_link'     => 'Add State',
					'label_search'    => null,
					'search_value'    => null
				));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$this->urlService->getUrlPrevious($this->directory_files);

	  	return View::make($this->directory_files .'/create')
	  		->with(array('countries_names' => $this->generalService->setKeyAndNameToArray($this->countryRepository->getAllCountries(), 'country_name')));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */	
	public function store(Request $request)
	{
		// validate the fields base on the rules define
		$validator=$this->validationService->validateInputs($this->stateRepository->getModel(), $request->all(), 'state.add', 'validation.states');
		// Send to view the errros messages and the input data
		if ($validator->fails()) {

			return redirect()->route('data.states.create')->withInput()->withErrors($validator);
		} 			
	
		if ($this->stateRepository->store($request)){

			Event::fire(new RegisterTransactionAccessEvent('data.states.store'));
		}

			
		return redirect()->route('data.states.create');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$this->urlService->setUrlPrevious();
		// find a state id to access its information
		Event::fire(new RegisterTransactionAccessEvent('data.states.view'));
        //show state info in the view
        return View::make($this->directory_files .'/show')
        	->with('state', $this->stateRepository->getStateNameByID($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$state = $this->stateRepository->getStateNameByID($id);

  		$this->urlService->setUrlPrevious (URL::route('data.states.country_selected' , $state[0]->country_id));

		Event::fire(new RegisterTransactionAccessEvent('data.states.edit'));

		//show the edit form and pass the transaction
        return View::make($this->directory_files .'/edit')
            ->with(array('state' => $state));
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
		$validator=$this->validationService->validateInputs($this->stateRepository->getModel(), $request->all(), 'state.update', 'validation.states');
        // Send to view the errors messages
        if ($validator->fails()) {

        	return redirect()->route('data.states.edit', $id)->withErrors($validator);
        } 
        // update the data to the database
	 	if ($this->stateRepository->update($id, $request)){

	 		Event::fire(new RegisterTransactionAccessEvent('data.states.update'));	
	 	}
			
		return redirect()->route('data.states.country_selected', Session::get('countryIDSelected'));
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
      	if ($this->stateRepository->delete($id)){

      		Event::fire(new RegisterTransactionAccessEvent('data.states.delete'));
      	}
	 	//return to the previous url in case the delete fail
      	return redirect()->back();
	}

	/**
	 * Search a string input by the user.
	 *
	 * @return Response
	 */
	public function getSearch(Request $request) 
	{
		$value= $request->input('search_value');
		//set a color tag with the fileter
		$label_search= $value;

		Event::fire(new RegisterTransactionAccessEvent('data.states.search'));
		//make the view and return the item filtered
		return View::make($this->directory_files .'/list')
			->with(
				array(
					'states'       => $this->stateRepository->search($value, $this->itemsByPage),
					'create_link'  => 'Add State',
					'label_search' => $label_search,
					'search_value' => $value
				));
    	
	}

	/**
	 * Export all stateas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data = $this->stateRepository->getModel()->all();

		if ($this->documentService->export($data, 'csv', 'States')){

			Event::fire(new RegisterTransactionAccessEvent('data.states.export'));
		}

		return redirect()->back();

	}


	public function getSelectImportFile($id) 
	{ 

		$this->urlService->getUrlPrevious($this->directory_files);
        //show the import form 
        return View::make($this->directory_files .'/import')
        	->with('country', $this->countryRepository->getCountryNameByID($id));
	}

	
	public function postImport(Request $request) 
	{ 

		$file= $this->validationService->getFile($request, true);
		//validate the request if file is missing send an error to user
		
		$countryID = $this->countryRepository->getucfirstcountryIdByucfirstcountryName($request->input('country_name'));
	
		if (isset($file)) {
				
			if ($this->stateRepository->import($file, $countryID)){

				Event::fire(new RegisterTransactionAccessEvent('data.states.import'));
			}

		}
		//Redirect to the import page
	   	return back();
	}
 

	public function postViewButton(Request $request)
	{

		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){
		
			return redirect()->back();
		}

		return redirect()->route('data.states.show', $checked_item);
	}	


	public function postEditButton(Request $request)
	{
		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){

			return redirect()->back();
		}

		return redirect()->route('data.states.edit', $checked_item);
	}	


	public function postDeleteButton(Request $request)
	{

		$checked_items= $this->validationService->getAllIdChecked($request, true);	

		if ($checked_items !== 0){
		
			foreach ($checked_items as $id) {

				$this->destroy($id);
		    }
		}

		return redirect()->back();
	}	


	public function getCountrySelected($countrySelected, Request $request)
	{

		if ($request->ajax()){

			$states=$this->stateRepository->getStatesByCountryId($countrySelected);

			return $states;
			
		}

		$states=$this->stateRepository->getStatesByCountryIdByPage($countrySelected, $this->itemsByPage);

		$countries= $this->countryRepository->getAllCountries();

		Session::put('countryIDSelected', $countrySelected);

		return View::make($this->directory_files .'/list')
			->with(
				array(
				'states'          => $states,
				'countries'       => $countries,
				'countries_names' => $this->generalService->setKeyAndNameToArray($countries, 'country_name'),
				'create_link'     => 'Add State',
				'label_search'    => null,
				'search_value'    => null
				));
	}


	


}	