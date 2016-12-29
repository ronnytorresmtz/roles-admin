<?php namespace Megacampus\Repositories\State;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\State\StateRepositoryInterface;

use  DB, Exception, Lang, State, Session;
 
class StateRepository extends MyAbstractEloquentRepository implements StateRepositoryInterface 
{
 
	// Properties

	protected $model;

	 
	//Constructor
	   
	public function __construct(State $model) 
	{
		$this->model = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}



	public function getAllStatesByPage($itemsByPage)
	{

		$states= $this->model->select(
				'states.id',
				'countries.country_name', 
				'states.state_name', 
				'states.state_description',
				'states.created_at',
				'states.updated_at')

            ->join('countries', 'states.country_id', '=', 'countries.id')

			->orderby('countries.country_name', 'ASC')
			->orderby('states.state_name', 'ASC')

            ->paginate($itemsByPage);

        return $states;

	}


	public function getAllStates()
	{

		$states = $this->model->select(
				'states.id',
				'countries.country_name',
				'states.state_name', 
				'states.state_description',
				'states.created_at',
				'states.updated_at')
        
        	->join('countries', 'states.country_id', '=', 'countries.id')


            ->orderby('countries.country_name', 'ASC')
			->orderby('states.state_name', 'ASC')

            ->get();

           // var_dump(\Response::json($foods));

		return $states;
	}

	public function getStateNameByID($id)
	{

		$modeTemplate= $this->model->select(
				'states.id',
				'countries.id as country_id', 
				'countries.country_name', 
				'states.state_name', 
				'states.state_description',
				'states.created_at',
				'states.updated_at')

            ->join('countries', 'states.country_id', '=', 'countries.id')

            ->where('states.id', '=', $id)

            ->orderby('countries.country_name', 'ASC')
			->orderby('states.state_name', 'ASC')

            ->get();

		return $modeTemplate;
	}

	/*public function getStatesByCountryName($countryName, $itemsByPage)
	{
		$state=  $this->model->select(
				'states.id',
				'countries.country_name', 
				'states.state_name', 
				'states.state_description',
				'states.created_at',
				'states.updated_at')
				
            ->join('countries', 'states.country_id', '=', 'countries.id')


            ->where('countries.country_name', '=', $countryName)

			
			->orderby('states.state_name', 'ASC')

            ->paginate($itemsByPage);

		return $state;
	}*/


	public function getStatesByCountryIdByPage($id, $itemsByPage)
	{

         $states=  $this->model->select(
				'states.id',
				'countries.country_name', 
				'states.state_name', 
				'states.state_description',
				'states.created_at',
				'states.updated_at')
				
            ->join('countries', 'states.country_id', '=', 'countries.id')

            ->where('countries.id', '=', $id)

			->orderby('states.state_name', 'ASC')

            ->paginate($itemsByPage);

		return $states;
	}


	public function getStatesByCountryId($id)
	{

         $states=  $this->model->select(
				'states.id',
				'countries.country_name', 
				'states.state_name', 
				'states.state_description',
				'states.created_at',
				'states.updated_at')
				
            ->join('countries', 'states.country_id', '=', 'countries.id')

            ->where('countries.id', '=', $id)

			->orderby('states.state_name', 'ASC')

            ->get();

		return $states;
	}
	
	
	
	public function store($request)
	{
		// find if exist the country_name and state_name contains in the request
		$state=$this->findState($request);
		
		// update because the state exist
		if ($state->count()>0){

			if (! $this->update($state[0]->id, $request)){
			 	
			 	return false;
			}

		} else {
			// add the state to the database
			if (! $this->save($request)){
			 	
			 	return false;
			}
		}

		return true;

	}


	public function findState($request)
	{

		$campus=$this->model->select('id')
			->where('country_id','=', $request->input('country_name'))
			->where('state_name','=', $request->input('state_name'))
			->get();

		return $campus;

	}



	public function save($request)
	{

		try{
			$model                            = new $this->model;		
			
			$model->country_id         = $request->input('country_name');
			$model->state_name        = $request->input('state_name');
			$model->state_description = $request->input('state_description');
			
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

			$model->state_name        = $request->input('state_name');
			$model->state_description = $request->input('state_description');
			
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


	public function delete($id)
	{

		try{
			// find a state id to delete it
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

		$states=$this->model->select(
			'states.id',
			'countries.country_name', 
			'states.state_name', 
			'states.state_description',
			'states.created_at',
			'states.updated_at')

        ->join('countries', 'states.country_id', '=', 'countries.id')

		->where('countries.country_name','like','%' . $value . '%')
		->where(function ($query) use ($value)
			{
				$query->orwhere('states.state_name','like','%' . $value . '%')
				  	  ->orwhere('states.state_description','like','%' . $value . '%');
		 	})

		->orderby('countries.country_name', 'ASC')
		->orderby('states.state_name', 'ASC')

	 	->paginate($itemsByPage);

		return $states;

	}


	public function import($file, $countryID)
	{

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		try {
			//load the file to the database	
			$states=\Excel::load($file->getRealPath(), function($reader) use ($countryID) {
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
							$rowId->institute_id              = $countryID;
							$rowId->state_name        = $row->state_name;
							$rowId->state_description = $row->state_description;
							$rowId->touch();  			//touch: update timestamps
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{

							$rowId                            = new $this->model;
							$rowId->institute_id              = $countryID;
							$rowId->state_name        = $row->state_name;
							$rowId->state_description = $row->state_description;
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
