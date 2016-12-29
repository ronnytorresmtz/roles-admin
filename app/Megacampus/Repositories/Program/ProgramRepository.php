<?php namespace Megacampus\Repositories\Program;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\Program\ProgramRepositoryInterface;

use  DB, Exception, Lang, Program, Session;
 
class ProgramRepository extends MyAbstractEloquentRepository implements ProgramRepositoryInterface 
{
 
	// Properties

	protected $model;

	 
	//Constructor
	   
	public function __construct(Program $model) 
	{
		$this->model = $model; 
	}


	public function getModel()
	{
		return  $this->model;
	}

	public function getAllPrograms()
	{

		$programs=$this->model->withTrashed()->get();

		return  $programs;
	}


	public function getAllProgramsByPage($itemsByPage)
	{

		$programs=$this->model->withTrashed()->paginate($itemsByPage);

		return  $programs;
	}

	
	public function store($request)
	{
		try{
			// store the data to the database
			$model                      = new Program;
			
			$model->program_id          = $request->input('program_id');
			$model->program_name        = $request->input('program_name');
			$model->program_description = $request->input('program_description');
			
			if (! $model->save()){
			
				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e){

			return  array('error' => true, 'message' =>  Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}	
	}


	public function update($id, $request)
	{
		try{
			// store the data to the database
			$model = $this->model->withTrashed()->find($id);

			$model->program_id          = $request->input('program_id');
			$model->program_name        = $request->input('program_name');
			$model->program_description = $request->input('program_description');
			$model->deleted_at          = null;

			$model->touch();
			
			if (! $model->update()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e){

			return  array('error' => true, 'message' =>  Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}	
	}


	public function delete($id)
	{
		try{
			// find a program id to delete it
			$model = $this->model->withTrashed()->find($id);

			if (! $model->delete()){

				return array('error' => true, 'message' => Lang::get('messages.error'));
			}

			return array('error' => false, 'message' => Lang::get('messages.success'));

		} catch (Exception $e){

			return  array('error' => true, 'message' =>  Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}	
	}
	

	public function search($value, $itemsByPage)
	{

		// find the string in the database and return the programs found
		return 	$this->model->where('program_id','like','%' . $value . '%')
							->where(function($query) use ($value){
								$query->orwhere('program_name','like','%' . $value . '%')
									  ->orwhere('program_description','like','%' . $value . '%');
							})
							->paginate($itemsByPage);
	}


	public function import($file)
	{

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		try {
			//load the file to the database	
			$programs=\Excel::load($file->getRealPath(), function($reader) {
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
							$rowId->program_id      	= $row->program_id;
							$rowId->program_name      	= $row->program_name;
							$rowId->program_description	= $row->program_description;
							$rowId->touch();  			//touch: update timestamps
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{

							$rowId                      = new $this->model;
							$rowId->program_id          = $row->program_id;
							$rowId->program_name        = $row->program_name;
							$rowId->program_description = $row->program_description;
							$rowId->save();
							$i++;
						}
					}
				}
				

				// Store the message information for the user in the Session Object
				if (($i+$j)==0){
					//messages.error_file_format'
					Session::flash('error', Lang::get('messages.error') . '<br> <br> <em>' . Lang::get('messages.error_file_format') . '</em>');

					DB::rollBack();

					return false;
				}else{
					//messages.successfully'
					Session::flash('info', Lang::get('messages.success_add') .'&nbsp;' .  $i .'&nbsp;' . Lang::get('messages.success_update') .'&nbsp;' . $j .'&nbsp;' . Lang::get('messages.successfully'));

					DB::commit();
					
					return true;
				} 
				
			})->get();

	    } catch (Exception $e) {
	    	//Set the message error to display
			Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
			//Rollback the Transaction
			DB::rollBack();

			return false;
		}

	}



	public function importFile($file)
	{

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		//try {

			$addedRecords=0; // caount add records
			$updateRecords=0; // count update records

			for ($i=1; $i <count($file) ; $i++) { 
				
				//validate if $id was found so UPDATE it
				if (array_key_exists('id', $file[$i])) {
		
					$rowId = $this->model->find($file[$i]['id']);
					
					$rowId->program_id      	= $file[$i]['program_id'];
					$rowId->program_name      	= $file[$i]['program_name'];
					$rowId->program_description	= $file[$i]['program_description'];
					$rowId->touch();  			//touch: update timestamps
					$rowId->save();
					$updateRecords++;
				}
				// validate no found so ADD it
				else{
					$rowId                      = new $this->model;
					$rowId->program_id      	= $file[$i]['program_id'];
					$rowId->program_name      	= $file[$i]['program_name'];
					$rowId->program_description	= $file[$i]['program_description'];
					$rowId->save();
					$addedRecords++;
				}

			}

			if (($addedRecords+$updateRecords)==0){
				//messages.error_file_format'
				Session::flash('error', Lang::get('messages.error') . '<br> <br> <em>' . Lang::get('messages.error_file_format') . '</em>');

				DB::rollBack();

				return false;
			}else{
				//messages.successfully'
				Session::flash('info', Lang::get('messages.success_add') .'&nbsp;' .  $addedRecords .'&nbsp;' . Lang::get('messages.success_update') .'&nbsp;' . $updateRecords .'&nbsp;' . Lang::get('messages.successfully'));

				DB::commit();
				
				return true;
			} 
	   /* } catch (Exception $e) {
		    	//Set the message error to display
				Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
				//Rollback the Transaction
				DB::rollBack();

				return false;
		}*/
			
	}	

}