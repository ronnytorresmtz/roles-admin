<?php

/**
 * Controller Name: CampusController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Campuss Information
 * 
 * Author: 
 *<203></203>
 *
  */
 
 //Keys_template: campus, campuss, Campus, ucfisrtModelTemplates
 //Keys_template: institute, institutes, Institute, ucfisrtSelectTemplates

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\Campus\CampusRepositoryInterface;
use Megacampus\Repositories\Institute\InstituteRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface as UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface as ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface as DocumentServiceInterface;
use Megacampus\Services\General\GeneralServiceInterface;


class CampusController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $campusRepository;
	protected $instituteRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;
	protected $generalService;


	private $directory_files = "facilities/campuss";

	private $itemsByPage = 100;


	public function __construct(CampusRepositoryInterface $campusRepository,
								InstituteRepositoryInterface $instituteRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService,
								GeneralServiceInterface $generalService)
	{

		$this->campusRepository    = $campusRepository;
		$this->instituteRepository = $instituteRepository;
		$this->urlService          = $urlService;
		$this->validationService   = $validationService;
		$this->documentService     = $documentService;
		$this->generalService      = $generalService;
	}


	public function index()
	{

		
		$this->urlService->forgetUrlPrevious();

		Event::fire(new RegisterTransactionAccessEvent('facilities.campuss.index'));

		$campuss=$this->campusRepository->getCampusByInstitute(1, $this->itemsByPage);

	  	return View::make($this->directory_files .'/list')
			->with(
				array(
					'institutes_names' => $this->generalService->setKeyAndNameToArray($this->instituteRepository->getAllInstitutes(),'institute_short_name'),
					'campuss'          => $campuss,
					'create_link'      => 'Add Campus',
					'label_search'     => null,
					'search_value'     => null
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
	  		->with(array(
	  			'institutes_names' => $this->generalService->setKeyAndNameToArray($this->instituteRepository->getAllInstitutes(),'institute_short_name')
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
		$validator=$this->validationService->validateInputs($this->campusRepository->getModel(), $request->all(), 'campus.add', 'validation.campuss');
		// Send to view the errros messages and the input data
		if ($validator->fails()) {

			return redirect()->route('facilities.campuss.create')->withInput()->withErrors($validator);
		} 			
	
		if ($this->campusRepository->store($request)){

			Event::fire(new RegisterTransactionAccessEvent('facilities.campuss.store'));
		}

			
		return redirect()->route('facilities.campuss.create');
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
		// find a campus id to access its information
		Event::fire(new RegisterTransactionAccessEvent('facilities.campuss.view'));
        //show campus info in the view
        return View::make($this->directory_files .'/show')
        	->with('campus', $this->campusRepository->getCampusNameByID($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$campus = $this->campusRepository->getCampusNameByID($id);

  		$this->urlService->setUrlPrevious (URL::route('facilities.campuss.institute_selected' , $campus[0]->institute_id));

		Event::fire(new RegisterTransactionAccessEvent('facilities.campuss.edit'));

		//show the edit form and pass the transaction
        return View::make($this->directory_files .'/edit')
            ->with(array('campus' => $campus));
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
		$validator=$this->validationService->validateInputs($this->campusRepository->getModel(), $request->all(), 'campus.update', 'validation.campuss');
        // Send to view the errors messages
        if ($validator->fails()) {

        	return redirect()->route('facilities.campuss.edit', $id)->withErrors($validator);
        } 
        // update the data to the database
	 	if ($this->campusRepository->update($id, $request)){

	 		Event::fire(new RegisterTransactionAccessEvent('facilities.campuss.update'));	
	 	}
			
		return redirect()->route('facilities.campuss.institute_selected', Session::get('instituteIDSelected'));
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
      	if ($this->campusRepository->delete($id)){

      		Event::fire(new RegisterTransactionAccessEvent('facilities.campuss.delete'));
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

		Event::fire(new RegisterTransactionAccessEvent('facilities.campuss.search'));
		//make the view and return the item filtered
		return View::make($this->directory_files .'/list')
			->with(
				array(
				'campuss'      => $this->campusRepository->search($value, $this->itemsByPage),
				'create_link'  => 'Add Campus',
				'label_search' => $label_search,
				'search_value' => $value
				));
    	
	}

	/**
	 * Export all campusas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data = $this->campusRepository->getModel()->all();

		if ($this->documentService->export($data, 'csv', 'Campuss')){

			Event::fire(new RegisterTransactionAccessEvent('facilities.campuss.export'));
		}

		return redirect()->back();

	}


	public function getSelectImportFile($id) 
	{ 

		$this->urlService->getUrlPrevious($this->directory_files);
        //show the import form 
        return View::make($this->directory_files .'/import')
       		->with('institute', $this->instituteRepository->getInstituteNameByID($id));

	
	}

	
	public function postImport(Request $request) 
	{ 
		$file= $this->validationService->getFile($request, true);
		//validate the request if file is missing send an error to user
		//
		$instituteID = $this->instituteRepository->getInstituteIdByInstituteName($request->input('institute_name'));
	
		if (isset($file)) {
				
			if ($this->campusRepository->import($file, $instituteID)){

				Event::fire(new RegisterTransactionAccessEvent('facilities.campuss.import'));
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

		return redirect()->route('facilities.campuss.show', $checked_item);
	}	


	public function postEditButton(Request $request)
	{
		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){

			return redirect()->back();
		}

		return redirect()->route('facilities.campuss.edit', $checked_item);
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


	public function getInstituteSelected($instituteSelected)
	{
	
		$campuss=$this->campusRepository->getCampusByInstitute($instituteSelected, $this->itemsByPage);

		$institutes= $this->instituteRepository->getAllInstitutes();

		Session::put('instituteIDSelected', $instituteSelected);

		return View::make($this->directory_files .'/list')
			->with(
				array(
				'campuss'          => $campuss,
				'institutes'       => $institutes,
				'institutes_names' => $this->generalService->setKeyAndNameToArray($this->instituteRepository->getAllInstitutes(),'institute_short_name'),
				'create_link'      => 'Add Campus',
				'label_search'     => null,
				'search_value'     => null
				));
	}	


	


}	