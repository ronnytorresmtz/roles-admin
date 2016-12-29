<?php

/**
 * Controller Name: ucfirstModelTemplateController
 *
 * Description: Controller to list, insert, update, delete, search, export and import ucfirstModelTemplates Information
 * 
 * Author: 
 *<203></203>
 *
  */
 
 //Keys_template: modelTemplate, modelTemplates, ucfirstModelTemplate, ucfisrtModelTemplates
 //Keys_template: selectTemplate, selectTemplates, ucfirstSelectTemplate, ucfisrtSelectTemplates

use Illuminate\Http\Request;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Repositories\ucfirstModelTemplate\ucfirstModelTemplateRepositoryInterface;
use Megacampus\Repositories\ucfirstSelectTemplate\ucfirstSelectTemplateRepositoryInterface;
use Megacampus\Services\Url\UrlServiceInterface;
use Megacampus\Services\Validation\ValidationServiceInterface;
use Megacampus\Services\Document\DocumentServiceInterface;
use Megacampus\Services\General\GeneralServiceInterface;


class ucfirstModelTemplateController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $modelTemplateRepository;
	protected $selectTemplateRepository;
	protected $urlService;
	protected $validationService;
	protected $documentService;
	protected $generalService;

	private $directory_files = "menuTemplate/modelTemplates";

	private $itemsByPage = 100;



	public function __construct(ucfirstModelTemplateRepositoryInterface $modelTemplateRepository,
								ucfirstSelectTemplateRepositoryInterface $selectTemplateRepository,
								UrlServiceInterface $urlService, 
								ValidationServiceInterface $validationService,
								DocumentServiceInterface $documentService,
								GeneralServiceInterface $generalService)
	{
	  $this->modelTemplateRepository = $modelTemplateRepository;
	  $this->selectTemplateRepository = $selectTemplateRepository;
	  $this->urlService=$urlService;
	  $this->validationService=$validationService;
	  $this->documentService=$documentService;
	  $this->generalService=$generalService;
	}


	public function index()
	{
		$this->urlService->forgetUrlPrevious();

		Event::fire(new RegisterTransactionAccessEvent('menuTemplate.modelTemplates.index'));

		$modelTemplates=$this->modelTemplateRepository->getucfirstModelTemplateByucfirstSelectTemplate(1, $this->itemsByPage);

	  	return View::make($this->directory_files .'/list')
			->with(
				array(
					'selectTemplates_names' => $this->generalService->collectionToArray($this->selectTemplateRepository->getAllucfirstSelectTemplates(),'selectTemplate_name'),
					'modelTemplates'        => $modelTemplates,
					'create_link'           => 'Add ucfirstModelTemplate',
					'label_search'          => null,
					'search_value'          => null
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
	  			'selectTemplates_names' => $this->generalService->collectionToArray($this->selectTemplateRepository->getAllucfirstSelectTemplates(),'selectTemplate_name')
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
		$validator=$this->validationService->validateInputs($this->modelTemplateRepository->getModel(), $request->all(), 'modelTemplate.add', 'validation.modelTemplates');
		// Send to view the errros messages and the input data
		if ($validator->fails()) {

			return redirect()->route('menuTemplate.modelTemplates.create')->withInput()->withErrors($validator);
		} 			
	
		if ($this->modelTemplateRepository->store($request)){

			Event::fire(new RegisterTransactionAccessEvent('menuTemplate.modelTemplates.store'));
		}

			
		return redirect()->route('menuTemplate.modelTemplates.create');
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

		Event::fire(new RegisterTransactionAccessEvent('menuTemplate.modelTemplates.view'));
        //show modelTemplate info in the view
        return View::make($this->directory_files .'/show')
        	->with('modelTemplate', $this->modelTemplateRepository->getucfirstModelTemplateNameByID($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$modelTemplate = $this->modelTemplateRepository->getucfirstModelTemplateNameByID($id);

  		$this->urlService->setUrlPrevious (URL::route('menuTemplate.modelTemplates.selectTemplate_selected' , $modelTemplate[0]->selectTemplate_id));

		Event::fire(new RegisterTransactionAccessEvent('menuTemplate.modelTemplates.edit'));

		//show the edit form and pass the transaction
        return View::make($this->directory_files .'/edit')
            ->with(array('modelTemplate' => $modelTemplate));
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
		$validator=$this->validationService->validateInputs($this->modelTemplateRepository->getModel(), $request->all(), 'modelTemplate.update', 'validation.modelTemplates');
        // Send to view the errors messages
        if ($validator->fails()) {

        	return redirect()->route('menuTemplate.modelTemplates.edit', $id)->withErrors($validator);
        } 
        // update the data to the database
	 	if ($this->modelTemplateRepository->update($id, $request)){

	 		Event::fire(new RegisterTransactionAccessEvent('menuTemplate.modelTemplates.update'));	
	 	}
			
		return redirect()->route('menuTemplate.modelTemplates.selectTemplate_selected', Session::get('selectTemplateIDSelected'));
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
      	if ($this->modelTemplateRepository->delete($id)){

      		Event::fire(new RegisterTransactionAccessEvent('menuTemplate.modelTemplates.delete'));
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

		Event::fire(new RegisterTransactionAccessEvent('menuTemplate.modelTemplates.search'));
		//make the view and return the item filtered
		return View::make($this->directory_files .'/list')
			->with(
				array(
				'modelTemplates' => $this->modelTemplateRepository->search($value, $this->itemsByPage),
				'create_link'    => 'Add ucfirstModelTemplate',
				'label_search'   => $label_search,
				'search_value'   => $value
				));
    	
	}

	/**
	 * Export all modelTemplateas to Excel
	 *
	 * @return Response
	 */
	public function getExport() 
	{ 

		$data = $this->modelTemplateRepository->getModel()->all();

		if ($this->documentService->export($data, 'csv', 'ucfirstModelTemplates')){

			Event::fire(new RegisterTransactionAccessEvent('menuTemplate.modelTemplates.export'));
		}

		return redirect()->back();

	}


	public function getSelectImportFile($id) 
	{ 

		$this->urlService->getUrlPrevious($this->directory_files);
        //show the import form 
        return View::make($this->directory_files .'/import')
        	->with('selectTemplate', $this->selectTemplateRepository->getucfirstSelectTemplateNameByID($id));
	}

	
	public function postImport(Request $request) 
	{ 

		$file= $this->validationService->getFile($request, true);
		//validate the request if file is missing send an error to user
		
		$selectTemplateID = $this->selectTemplateRepository->getucfirstSelectTemplateIdByucfirstSelectTemplateName($request->input('selectTemplate_name'));
	
		if (isset($file)) {
				
			if ($this->modelTemplateRepository->import($file, $selectTemplateID)){

				Event::fire(new RegisterTransactionAccessEvent('menuTemplate.modelTemplates.import'));
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

		return redirect()->route('menuTemplate.modelTemplates.show', $checked_item);
	}	


	public function postEditButton(Request $request)
	{
		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){

			return redirect()->back();
		}

		return redirect()->route('menuTemplate.modelTemplates.edit', $checked_item);
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


	public function getucfirstSelectTemplateSelected($selectTemplateSelected)
	{
	
		$modelTemplates=$this->modelTemplateRepository->getucfirstModelTemplateByucfirstSelectTemplate($selectTemplateSelected, $this->itemsByPage);

		Session::put('selectTemplateIDSelected', $selectTemplateSelected);

		return View::make($this->directory_files .'/list')
			->with(
				array(
				'modelTemplates'        => $modelTemplates,
				'selectTemplates'       => $selectTemplates,
				'selectTemplates_names' => $$this->generalService->collectionToArray($selectTemplates,'selectTemplate_name'),
				'create_link'           => 'Add ucfirstModelTemplate',
				'label_search'          => null,
				'search_value'          => null
				));
	}


	


}	