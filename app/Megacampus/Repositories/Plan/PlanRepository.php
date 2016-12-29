<?php namespace Megacampus\Repositories\Plan;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Services\Graph\GraphServiceInterface;
use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\Plan\PlanRepositoryInterface;

use  DB, Exception, Lang, Plan, Session;
 
class PlanRepository extends MyAbstractEloquentRepository implements PlanRepositoryInterface 
{
 
	// Properties

	protected $model;

	 
	//Constructor
	   
	public function __construct(Plan $model) 
	{
		$this->model        = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}

	public function getAllPlans($itemsByPage)
	{
	
		$plans=$this->model->withTrashed()->paginate($itemsByPage);

		return  $plans;
	}

	public function getPlanNameByID($id)
	{

		$plan=$this->model->where('id', '=', $id)->first();

		return $plan;
	}

	public function getPlanIdByPlanName($planName)
	{

		$plan=$this->model->where('plan_name', '=', $planName)->first(array('id'));

		$id=null;

		if (isset($plan)){
			
			$plan=$plan->toArray();

			$id= array_pop($plan);
		}

		return $id;
	}
	
	
	public function store($request)
	{
		try{
			// store the data to the database
			$model                   = new Plan;		
			
			$model->plan_id          = $request->input('plan_id');
			$model->plan_name        = $request->input('plan_name');
			$model->plan_description = $request->input('plan_description');
			
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

			$model->plan_id          = $request->input('plan_id');
			$model->plan_name        = $request->input('plan_name');
			$model->plan_description = $request->input('plan_description');
			$model->deleted_at       = null;
			
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
			// find a plan id to delete it
			$model = $this->model->withTrashed()->find($id);

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

		// find the string in the database and return the plans found
		return 	$this->model->where('plan_name','like','%' . $value . '%')
							->where(function($query) use ($value){
								$query->orwhere('plan_description','like','%' . $value . '%');
							})
							->paginate($itemsByPage);
	}


	/*public function import($file)
	{
*/
		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
	/*
		// Begin a Transaction
		DB::beginTransaction();

		try {
			//load the file to the database	
			$plans=\Excel::load($file->getRealPath(), function($reader) {
				//get the file content / data
				$results = $reader->get();	
				$i=0; // caount add records
				$j=0; // count update records
				foreach ($results as $key => $row) {
					// Validate if the file uploaded has the ID field
					if (isset($row)) {
						// find the id to decide if it wil be an update or add process
						$rowId= $this->model->find($row->id);
						
						//validate if $id was found so UPDATE it
						if ($rowId) {
							$rowId->plan_name        = $row->plan_name;
							$rowId->plan_description = $row->plan_description;
							$rowId->deleted_at		 = null;
							$rowId->touch();  			//touch: update timestamps
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{

							$rowId                   = new $this->model;
							$rowId->plan_name        = $row->plan_name;
							$rowId->plan_description = $row->plan_description;
							$rowId->deleted_at		 = null;
							$rowId->save();
							$i++;
						}
					}
				}
				
				if (($i+$j)==0){
					
					DB::rollBack();
					
					return array('error' => true, 'message' => Lang::get('messages.error') . '<br> <br> <em>' . Lang::get('messages.error_file_format') . '</em>');
				}else{
					//messages.successfully'
					DB::commit();
					
					return array('error' => false, 'message' => Lang::get('messages.success_add') .'&nbsp;' .  $i .'&nbsp;' . Lang::get('messages.success_update') .'&nbsp;' . $j .'&nbsp;' . Lang::get('messages.successfully'));
				} 
				
			})->get();

	    } catch (Exception $e) {
			
			DB::rollBack();

			return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}

	}*/


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
					
					$rowId->plan_id          = $file[$i]['plan_id'];
					$rowId->plan_name        = $file[$i]['plan_name'];
					$rowId->plan_description = $file[$i]['plan_description'];
					$rowId->deleted_at       = null;
					$rowId->touch();  			//touch: update timestamps
					$rowId->save();
					$updateRecords++;
				}
				// validate no found so ADD it
				else{
					$rowId                   = new $this->model;
					$rowId->plan_id          = $file[$i]['plan_id'];
					$rowId->plan_name        = $file[$i]['plan_name'];
					$rowId->plan_description = $file[$i]['plan_description'];
					$rowId->deleted_at       = null;
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

	

}