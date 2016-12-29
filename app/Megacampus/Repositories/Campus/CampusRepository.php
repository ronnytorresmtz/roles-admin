<?php namespace Megacampus\Repositories\Campus;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\Campus\CampusRepositoryInterface;

use  DB, Exception, Lang, Campus, Session;
 
class CampusRepository extends MyAbstractEloquentRepository implements CampusRepositoryInterface 
{
 
	// Properties

	protected $model;

	 
	//Constructor
	   
	public function __construct(Campus $model) 
	{
		$this->model = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}



	public function getAllCampussByPage($itemsByPage)
	{

		$campuss= $this->model->select(
				'campuss.id',
				'institutes.institute_short_name', 
				'institutes.institute_long_name',
				'campuss.campus_name', 
				'campuss.campus_description',
				'campuss.created_at',
				'campuss.updated_at')

            ->join('institutes', 'campuss.institute_id', '=', 'institutes.id')

			->orderby('institutes.institute_short_name', 'ASC')
			->orderby('campuss.campus_name', 'ASC')

            ->paginate($itemsByPage);

        return $campuss;

	}


	public function getAllCampuss()
	{

		$campuss = $this->model->select(
				'campuss.id',
				'institutes.institute_short_name', 
				'institutes.institute_long_name',
				'campuss.campus_name', 
				'campuss.campus_description',
				'campuss.created_at',
				'campuss.updated_at')
        
        	->join('institutes', 'campuss.institute_id', '=', 'institutes.id')

            ->orderby('institutes.institute_short_name', 'ASC')
			->orderby('campuss.campus_name', 'ASC')

            ->get();

           // var_dump(\Response::json($foods));

		return $campuss;
	}

	public function getCampusNameByID($id)
	{

		$modeTemplate= $this->model->select(
				'campuss.id',
				'institutes.institute_short_name', 
				'institutes.institute_long_name',
				'campuss.campus_name', 
				'campuss.campus_description',
				'campuss.created_at',
				'campuss.updated_at')

            ->join('institutes', 'campuss.institute_id', '=', 'institutes.id')

            ->where('campuss.id', '=', $id)

            ->orderby('institutes.institute_short_name', 'ASC')
			->orderby('campuss.campus_name', 'ASC')

            ->get();

		return $modeTemplate;
	}

	public function getCampusIdByCampusName($campusName)
	{
		$campus=  $this->model->select(
				'campuss.id',
				'institutes.institute_short_name', 
				'institutes.institute_long_name',
				'campuss.campus_name', 
				'campuss.campus_description',
				'campuss.created_at',
				'campuss.updated_at')
				
            ->join('institutes', 'campuss.institute_id', '=', 'institutes.id')


            ->where('campuss.institute_id', '=', $id)
			
			->orderby('campuss.campus_name', 'ASC')

            ->paginate($itemsByPage);

		return $campus;
	}
	
	
	public function getCampusByInstitute($id, $itemsByPage)
	{

         $campuss=  $this->model->select(
				'campuss.id',
				'institutes.institute_short_name', 
				'institutes.institute_long_name',
				'campuss.campus_name', 
				'campuss.campus_description',
				'campuss.created_at',
				'campuss.updated_at')
				
            ->join('institutes', 'campuss.institute_id', '=', 'institutes.id')

            ->where('institutes.id', '=', $id)

			->orderby('campuss.campus_name', 'ASC')

            ->paginate($itemsByPage);

		return $campuss;
	}


	public function store($request)
	{
		// find if exist the institute_short_name and campus_name contains in the request
		$campus=$this->findCampus($request);
		
		// update because the campus exist
		if ($campus->count()>0){

			if (! $this->update($campus[0]->id, $request)){
			 	
			 	return false;
			}

		} else {
			// add the campus to the database
			if (! $this->save($request)){
			 	
			 	return false;
			}
		}

		return true;

	}


	public function findCampus($request)
	{

		$campus=$this->model->select('id')
			->where('institute_id','=', $request->input('institute_name'))
			->where('campus_name','=', $request->input('campus_name'))
			->get();

		return $campus;

	}


	public function save($request)
	{

		try{
			$model                            = new $this->model;		
			
			$model->institute_id         = $request->input('institute_name');
			$model->campus_name        = $request->input('campus_name');
			$model->campus_description = $request->input('campus_description');
			
			if (! $model->save()){

				Session::flash('error', Lang::get('messages.error'));

				return false;
			}

			Session::flash('info', Lang::get('messages.success'));

			return true;


		} catch (Exception $e) {
			
			Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));

			return false;
		}	

	}



	public function update($id, $request)
	{
		try{
			// store the data to the database
			$model = $this->model->find($id);

			$model->campus_name        = $request->input('campus_name');
			$model->campus_description = $request->input('campus_description');
			
			$model->touch();
			
			if (! $model->update()){

				Session::flash('error', Lang::get('messages.error'));

				return false;
			}

			Session::flash('info', Lang::get('messages.success'));

			return true;

		} catch (Exception $e) {
			
			Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));

			return false;
		}	
	}


	public function delete($id){

		try{
			// find a campus id to delete it
			$model = $this->model->find($id);
			//validate if $id was not found
			if ( ! isset($model)) {
		     	//return to the previous url
		     	Session::flash('error', Lang::get('messages.error'));

		      	return false;
			}

			if (! $model->delete()){

				Session::flash('error', Lang::get('messages.error'));

				return false;
			}

			Session::flash('info', Lang::get('messages.success'));

			return true;

		} catch (Exception $e) {
			
			Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));

			return false;
		}	
	}


	public function search($value, $itemsByPage)
	{

		$campuss=$this->model->select(
			'campuss.id',
			'institutes.institute_short_name', 
			'institutes.institute_long_name',
			'campuss.campus_name', 
			'campuss.campus_description',
			'campuss.created_at',
			'campuss.updated_at')

        ->join('institutes', 'campuss.institute_id', '=', 'institutes.id')

		->where('institutes.institute_short_name','like','%' . $value . '%')
		->where(function ($query) use ($value)
			{
				$query->orwhere('campuss.campus_name','like','%' . $value . '%')
				  	  ->orwhere('campuss.campus_description','like','%' . $value . '%');
		 	})

		->orderby('institutes.institute_short_name', 'ASC')
		->orderby('campuss.campus_name', 'ASC')


	 	->paginate($itemsByPage);

	return $campuss;
	}


	public function import($file, $instituteID)
	{

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		try {
			//load the file to the database	
			$campuss=\Excel::load($file->getRealPath(), function($reader) use ($instituteID) {
				//get the file content / data
				$results = $reader->get();	
				$i=0; // caount add records
				$j=0; // count update records
				foreach ($results as $key => $row)  {
					// Validate if the file uploaded has the ID field
					if (isset($row)) {
						// find the id to decide if it wil be an update or add process
						$rowId= $this->model->find($row->id);
						//validate if $id was found so UPDATE it
						if ($rowId) {
							$rowId->institute_id        = $instituteID;
							$rowId->campus_name      	= $row->campus_name;
							$rowId->campus_description	= $row->campus_description;
							$rowId->touch();  			//touch: update timestamps
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{
							$rowId                     = new $this->model;
							$rowId->institute_id       = $instituteID;
							$rowId->campus_name        = $row->campus_name;
							$rowId->campus_description = $row->campus_description;
							$rowId->save();
							$i++;
						}
					}
				}
				

				// Store the message information for the user in a flash session
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

}	

