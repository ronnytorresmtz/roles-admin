<?php

/**
 * Controller Name: CityController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Cities Information
 * 
 * Author: 
 *<203></203>
 *
  */
 
 //Keys_template: city, cities, City, ucfisrtModelTemplates
 //Keys_template: state, states, State, ucfisrtSelectTemplates

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\City\CityRepositoryInterface;
use Megacampus\Repositories\State\StateRepositoryInterface;
use Megacampus\Repositories\Country\CountryRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface as UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface as ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface as DocumentServiceInterface;
use Megacampus\Services\General\GeneralServiceInterface;


class CityController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	protected $cityRepository;
	protected $stateRepository;
	protected $countryRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;
	protected $generalService;

	private $directory_files = "data/cities";

	private $itemsByPage = 100;

	public function __construct(CityRepositoryInterface $cityRepository,
								StateRepositoryInterface $stateRepository,
								CountryRepositoryInterface $countryRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService,
								GeneralServiceInterface $generalService)
	{
		$this->cityRepository    = $cityRepository;
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

		Event::fire(new RegisterTransactionAccessEvent('data.cities.index'));

		Session::put('countryIDSelected', 1);
		Session::put('stateIDSelected', 1);

	  	return View::make($this->directory_files .'/list')
			->with(
				array(
					'countries_names' => $this->generalService->setKeyAndNameToArray($this->countryRepository->getAllCountries(), 'country_name'),
					'states_names'    => $this->generalService->setKeyAndNameToArray($this->stateRepository->getStatesByCountryId(1), 'state_name'),
					'cities'          => $this->cityRepository->getCitiesbyStateNameByPage(Session::get('stateIDSelected'),Session::get('countryIDSelected'), $this->itemsByPage),
					'create_link'     => 'Add City',
					'label_search'    => null,
					'search_value'    => null
				));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		
		$this->urlService->getUrlPrevious($this->directory_files);

		$countryId = ((Session::has('countryIDSelected')) ? Session::get('countryIDSelected') : 1);

		return View::make($this->directory_files .'/create')
	  		->with(array(
				'countryId'       => $countryId,
				'stateId'         => ((Session::has('stateIDSelected')) ? Session::get('stateIDSelected') : 1),
				'countries_names' => $this->generalService->setKeyAndNameToArray($this->countryRepository->getAllCountries(), 'country_name'),
				'states_names'    => $this->generalService->setKeyAndNameToArray($this->stateRepository->getStatesByCountryId($countryId), 'state_name')
	  		));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */	
	public function store(Request $request)
	{
		// validate the fields base on the rules define
		$validator=$this->validationService->validateInputs($this->cityRepository->getModel(), $request->all(), 'city.add', 'validation.cities');
		// Send to view the errros messages and the input data
		if ($validator->fails()) {

			return redirect()->route('data.cities.create')->withInput()->withErrors($validator);
		} 			
	
		if ($this->cityRepository->store($request)){

			Event::fire(new RegisterTransactionAccessEvent('data.cities.store'));
		}

			
		return redirect()->route('data.cities.create');
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

		Event::fire(new RegisterTransactionAccessEvent('data.cities.view'));
        //show city info in the view
        return View::make($this->directory_files .'/show')
        	->with('city', $this->cityRepository->getCityNameByID($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$city=$city = $this->cityRepository->getCityNameByID($id);

		$this->urlService->setUrlPrevious (URL::route('data.cities.state_selected' , $city[0]->state_id));

		Event::fire(new RegisterTransactionAccessEvent('data.cities.edit'));

		//show the edit form and pass the transaction
        return View::make($this->directory_files .'/edit')
            ->with(array('city' => $city));
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
		$validator=$this->validationService->validateInputs($this->cityRepository->getModel(), $request->all(), 'city.update', 'validation.cities');
        // Send to view the errors messages
        if ($validator->fails()) {

        	return redirect()->route('data.cities.edit', $id)->withErrors($validator);
        } 
        // update the data to the database
	 	if ($this->cityRepository->update($id, $request)){

	 		Event::fire(new RegisterTransactionAccessEvent('data.cities.update'));	
	 	}
			
		return redirect()->route('data.cities.state_selected', Session::get('stateIDSelected'));
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
      	if ($this->cityRepository->delete($id)){

      		Event::fire(new RegisterTransactionAccessEvent('data.cities.delete'));
      	}
	 	//return to the previous url in case the delete fail
      	return redirect()->back();
	}

	/**
	 * Search a string input by the user.
	 *
	 * @return Response
	 */
	/*public function getSearch(Request $request) 
	{
		$value= $request->input('search_value');
		//get all the cities found with the filter applied	
		$cities=$this->cityRepository->search($value, $this->itemsByPage);
		//set a color tag with the fileter
		$label_search= $value;

		Event::fire(new RegisterTransactionAccessEvent('data.cities.search'));
		//make the view and return the item filtered
		return View::make($this->directory_files .'/list')
			->with(
				array(
				'cities' => $cities,
				'create_link'    => 'Add City',
				'label_search'   => $label_search,
				'search_value'   => $value
				));
    	
	}*/

	/**
	 * Export all cityas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data = $this->cityRepository->getModel()->all();

		if ($this->documentService->export($data, 'csv', 'Cities')){

			Event::fire(new RegisterTransactionAccessEvent('data.cities.export'));
		}

		return redirect()->back();

	}


	public function getSelectImportFile($id) 
	{ 

		$this->urlService->getUrlPrevious($this->directory_files);
        //show the import form 
        return View::make($this->directory_files .'/import')
        	->with('state', $this->stateRepository->getModelStateNameByID($id));
	}

	
	public function postImport(Request $request) 
	{ 

		$file= $this->validationService->getFile($request, true);
		//validate the request if file is missing send an error to user
		
		$stateID = $this->stateRepository->getStateIdByStateName($request->input('state_name'));
	
		if (isset($file)) {
				
			if ($this->cityRepository->import($file, $stateID)){

				Event::fire(new RegisterTransactionAccessEvent('data.cities.import'));
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

		return redirect()->route('data.cities.show', $checked_item);
	}	


	public function postEditButton(Request $request)
	{
		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){

			return redirect()->back();
		}

		return redirect()->route('data.cities.edit', $checked_item);
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


	public function getStateSelected($countrySelected, $stateSelected)
	{

		Session::put('stateIDSelected', $stateSelected);

		return View::make($this->directory_files .'/list')
			->with(
				array(
				'countries_names' => $this->generalService->setKeyAndNameToArray($this->countryRepository->getAllCountries(), 'country_name'),
				'states_names'    => $this->generalService->setKeyAndNameToArray($this->stateRepository->getStatesByCountryId($countrySelected), 'state_name'),
				'cities'          => $this->cityRepository->getCitiesByStateIDByPage($stateSelected, $this->itemsByPage),
				'create_link'     => 'Add City',
				'label_search'    => null,
				'search_value'    => null
				//'states'          => $this->generalService->setKeyAndNameToArray($this->stateRepository->getStatesByCountryId($countrySelected)),
				));
	}


	public function getStatesByCountrySelected($countrySelected)
	{

		$states_names=$this->stateRepository->getStatesByCountryId($countrySelected);

		Session::put('countryIDSelected', $countrySelected);
		Session::put('stateIDSelected', $states_names->first()->id);

		return View::make($this->directory_files .'/list')
			->with(
				array(
					'countries_names' => $this->generalService->setKeyAndNameToArray($this->countryRepository->getAllCountries(),'country_name'),
					'states_names'    => $this->generalService->setKeyAndNameToArray($states_names, 'state_name'),
					'cities'          => $this->cityRepository->getCitiesbyStateNameByPage(Session::get('stateIDSelected'), $countrySelected, $this->itemsByPage),
					'create_link'     => 'Add City',
					'label_search'    => null,
					'search_value'    => null
				));
	}

	


}	