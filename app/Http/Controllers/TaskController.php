<?php

/**
 * Controller Name: ModuleController
 *
 * Description: Controller to list, insert, update, delete, search, export and import Modules Information
 * 
 * Author: 
 *<203></203>
  */

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Services\Validation\ValidationServiceInterface;
use Megacampus\Repositories\Task\TaskRepositoryInterface;
use Megacampus\Repositories\TaskLog\TaskLogRepositoryInterface;
use Megacampus\Services\Log\LogServiceInterface;



class MaintenanceTaskController  extends Controller {

	
	protected $taskRepository;
	protected $validationService;
	protected $logService;

	private $itemsByPage=50;

	
	public function __construct(TaskRepositoryInterface $taskRepository,
								ValidationServiceInterface $validationService, 
							    LogServiceInterface $logService)
	{
		$this->model    		 =$taskRepository;
		$this->validationService =$validationService;
		$this->logService        =$logService;
	}


	public function index()
	{
		
		Event::fire(new RegisterTransactionAccessEvent('settings.maintenanceTasks.index'));

		$tasks= $this->model->all();

		return view('settings.maintenance_tasks.list')
					->with(
						array(
						'tasks' => $tasks,
						'label_search' => null,
						'search_value' => null
						));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */	
	public function store(Request $request)
	{
					
	
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

	}


	/**
	 * Search a string input by the user.
	 *
	 * @return Response
	 */
	public function getSearch(Request $request) 
	{
		$value= $request->input('search_value');
		//get all the modules found with the filter applied	
		$tasks=$this->model->search($value, $this->itemsByPage);
		//set a color tag with the fileter
		$label_search= $value;

		Event::fire(new RegisterTransactionAccessEvent('settings.maintenanceTasks.search'));

		//make the view and return the item filtered
		return View::make('settings.maintenance_tasks.list')
			->with(
				array(
				'tasks' 		=> $tasks,
				'label_search'	=> $label_search,
				'search_value'  => $value
				));
    	
	}

	
	public function postExecuteButton(Request $request)
	{


		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){
		
			return redirect()->back();
		}

		Event::fire(new RegisterTransactionAccessEvent('settings.maintenanceTasks.execute'));

		return $this->model->executeCommand($request); 
		
		//return redirect()->route('settings.maintenance_tasks.index');
	}	


	public function postViewLogButton(Request $request)
	{

		$checked_item= $this->validationService->getIdChecked($request, true);	

		if ($checked_item == 0){
		
			return redirect()->back();
		}

		$tasksLog= $this->model->getTaskLogbyId($checked_item);

		Event::fire(new RegisterTransactionAccessEvent('settings.maintenanceTasks.viewLog'));

		return View::make('settings.maintenance_tasks.view_log')
					->with(
						array(
						'tasksLog' => $tasksLog
	//					'label_search' => null,
	//					'search_value' => null
						));
	}





}	