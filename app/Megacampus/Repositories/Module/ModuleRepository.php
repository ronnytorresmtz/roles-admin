<?php namespace Megacampus\Repositories\Module;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\Module\ModuleRepositoryInterface;

use  DB, Exception, UserActionLog, Lang, Module, Session;
 
class ModuleRepository extends MyAbstractEloquentRepository implements ModuleRepositoryInterface 
{
 
	// Properties

	protected $model;

	 
	//Constructor
	   
	public function __construct(Module $model) 
	{
	    $this->model = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}

	public function getAllModules($itemsByPage)
	{
		
		$modules=$this->model->withTrashed()->paginate($itemsByPage);

		return $modules;
	}

	public function getAllModulesActive($itemsByPage = null)
	{

		if ($itemsByPage)
			$modules=$this->model->select(['id','module_name'])->paginate($itemsByPage);
		else
			$modules=$this->model->select(['id','module_name'])->get();

		return $modules;
	}


	public function getModuleByID($id)
	{

		$module=$this->model->where('id', '=', $id)->first();

		return $module;
	}

	public function getModuleIDByModuleName($moduleName)
	{

		$moduleID=$this->model->where('module_name', '=', $moduleName)->first();

		return $moduleID->id;
	}



	public function store($request)
	{
		try{
			// store the data to the database
			$model                   = new Module;		
			
			$model->module_name        = $request->input('module_name');
			$model->module_description = $request->input('module_description');
			$model->module_order			 = $request->input('module_order');
			
			if (! $model->save()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e) {
			
			 return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}	

	}


	public function update($id, $request)
	{
		try{
			// store the data to the database
			$model = $this->model->withTrashed()->find($id);

			$model->module_name        = $request->input('module_name');
			$model->module_description = $request->input('module_description');
			$model->module_order			 = $request->input('module_order');
			$model->deleted_at      	 = null;

			$model->touch();
			
			if (! $model->update()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e) {

			return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}	
	}


	public function delete($id){

		try{
			// find a module id to delete it
			$model = $this->model->withTrashed()->find($id);
			//validate if $id was not found
			if (! $model->delete()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e) {
			
			return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}	
	}


	public function search($value, $itemsByPage)
	{

		// find the string in the database and return the modules found
		return 	$this->model->withTrashed()->where('id','like','%' . $value . '%')
							->orwhere(function ($query) use ($value){
								$query->orwhere('module_name','like','%' . $value . '%')
											->orwhere('module_description','like','%' . $value . '%')
											->orwhere('module_order','like','%' . $value . '%');
							})
							->paginate($itemsByPage);
	}


	public function importFile($file)
	{

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		try {

			$addedRecords=0; // caount add records
			$updateRecords=0; // count update records

			for ($i=1; $i <count($file) ; $i++) { 
				
				//validate if $id was found so UPDATE it
				if (array_key_exists('id', $file[$i])) {
		
					$rowId = $this->model->find($file[$i]['id']);
					
					$rowId->module_name        = $file[$i]['module_name'];
					$rowId->module_description = $file[$i]['module_description'];
					$rowId->module_order			 = $file[$i]['module_order'];
					$rowId->deleted_at       	 = null;
					$rowId->touch();  			//touch: update timestamps
					$rowId->save();
					$updateRecords++;
				}
				// validate no found so ADD it
				else{
					$rowId                     = new $this->model;
					$rowId->module_name        = $file[$i]['module_name'];
					$rowId->module_description = $file[$i]['module_description'];
					$rowId->module_description = $file[$i]['module_order'];
					$rowId->deleted_at          = null;
					$rowId->save();
					$addedRecords++;
				}

			}

			if (($addedRecords+$updateRecords)==0){
				//messages.error_file_format'
				DB::rollBack();

				return array('error' => true, 'message' => Lang::get('messages.error') . '<br> <br> <em>' . Lang::get('messages.error_file_format') . '</em>');
			}else{
				//messages.successfully'
				DB::commit();
				
				return array('error' => false, 'message' => Lang::get('messages.success_add') .'&nbsp;' .  $addedRecords .'&nbsp;' . Lang::get('messages.success_update') .'&nbsp;' . $updateRecords .'&nbsp;' . Lang::get('messages.successfully'));
			} 
	   } catch (Exception $e) {
				DB::rollBack();

				return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}
			
	}	


 	public function getModulesUsedbyDay($request)
    {
		$modulesByMonthDay = DB::select('
		Select month, day, count(*) modules 
		From
			(Select 
				month(created_at) as month, day(created_at) as day, module_name  
				From users_actions_log
			Where month(created_at) = ' . $request->month . ' and year(created_at) =' . $request->year . 
			' group by month, day, module_name) as ModulebyMonth

			Group By month, day'
		);

		$daysArray=[];
		$currentDate=getdate();
		//reset all days with 0 for the days of the month (30,31,28,29)
		for ($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $request->month , $request->year); $i++) { 

			array_push($daysArray, $i);

			if ($request->year < $currentDate['year']){
					$moduleByDay['series'][]=0;
			}	else {
			if (($i > $currentDate['mday']) && ($request->month == $currentDate['mon']) || ($request->year > $currentDate['year'])) {
				$moduleByDay['series'][]=null;
			} 
			else {
				$moduleByDay['series'][]=0;
			}
			}
		}
		
		//fill days with values
		foreach ($modulesByMonthDay as $dayAndValue) {
			$moduleByDay['series'][$dayAndValue->day-1]=$dayAndValue->modules;
		}
		
		$moduleByDay['labels'] = $daysArray; 
		$moduleByDay['legend'] = ['Modules'];

		return $moduleByDay;
				
    }


  	public function getModulesUsed($request, $itemsByPage)
	{
		$moduleUsed = UserActionLog::select(DB::raw(
				'module_name, 
				count(id) as timeslogged'
		))

		->whereMonth('created_at','=', $request->month)
		->whereYear('created_at','=', $request->year)
		->groupBy('module_name')
		->orderBy ('timeslogged', 'desc')

		->paginate($itemsByPage);

		return $moduleUsed;

  	}

    public function getModulesUsedByMonth($request)
	{
		$modulesByMonth = DB::select('
			Select month, count(*) modules 
			From
			(Select 
				month(created_at) as month, module_name  
				From users_actions_log
			Where year(created_at) =' . $request->year . 
			' group by month, module_name) as ModulebyMonth

			Group By month'
		);

    	//reset all month with 0	
    	for ($i=0; $i < 12; $i++) { 
    		$MonthAndValues['series'][]=0;
    	}

    	//fill months with values
    	foreach ($modulesByMonth as $moduleByMonth) {
    		$MonthAndValues['series'][$moduleByMonth->month-1] = $moduleByMonth->modules;
    	}

    	$MonthAndValues['labels'] = Lang::get('calendar.shortMonths'); //shortMonths, longMonths, numericMonths
     	$MonthAndValues['legend'] = ['Modules'];
    	// retrun just the series data to update the graph
   		return $MonthAndValues;
    }

}