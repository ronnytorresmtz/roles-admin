<?php namespace Megacampus\Repositories\City;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\City\CityRepositoryInterface;

use  DB, Exception, Lang, City, Session;
 
class CityRepository extends MyAbstractEloquentRepository implements CityRepositoryInterface 
{
 
	// Properties

	protected $model;

	 
	//Constructor
	   
	public function __construct(City $model) 
	{
		$this->model        = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}



	public function getAllCitiesByPage($countryid, $stateId, $itemsByPage)
	{

		$cities= $this->model->select(
				'cities.id',
				'countries.country_name',
				'states.state_name', 
				'cities.city_name', 
				'cities.city_description',
				'cities.created_at',
				'cities.updated_at')

			->join('countries', 'cities.country_id', '=', 'countries.id')
            ->join('states', 'cities.state_id', '=', 'states.id')

			->orderby('states.state_name', 'ASC')
			->orderby('cities.city_name', 'ASC')

			->where('countries.id','=', $countryId)
			->where('states.id','=', $stateId)

            ->paginate($itemsByPage);

        return $cities;

	}


	public function getAllCities($countryId, $stateId)
	{

		$cities = $this->model->select(
				'cities.id',
				'countries.country_name',
				'states.state_name',
				'cities.city_name', 
				'cities.city_description',
				'cities.created_at',
				'cities.updated_at')
        
        	->join('countries', 'cities.country_id', '=', 'countries.id')
        	->join('states', 'cities.state_id', '=', 'states.id')

        	->where('countries.id','=', $countryId)
			->where('states.id','=', $stateId)

            ->orderby('states.state_name', 'ASC')
			->orderby('cities.city_name', 'ASC')

            ->get();

           // var_dump(\Response::json($foods));

		return $cities;
	}

	public function getCityNameByID($id)
	{

		$modeTemplate= $this->model->select(
				'cities.id',
				'countries.id as country_id', 
				'states.id as state_id', 
				'countries.country_name', 
				'states.state_name', 
				'cities.city_name', 
				'cities.city_description',
				'cities.created_at',
				'cities.updated_at')

			->join('countries', 'cities.country_id', '=', 'countries.id')
            ->join('states', 'cities.state_id', '=', 'states.id')

            ->where('cities.id', '=', $id)

            ->orderby('states.state_name', 'ASC')
			->orderby('cities.city_name', 'ASC')

            ->get();

		return $modeTemplate;
	}

	public function getCitiesbyStateNameByPage($stateId, $countryId, $itemsByPage)
	{
		$city=  $this->model->select(
				'cities.id',
				'countries.country_name',
				'states.state_name', 
				'cities.city_name', 
				'cities.city_description',
				'cities.created_at',
				'cities.updated_at')
				
			->join('countries', 'cities.country_id', '=', 'countries.id')
            ->join('states', 'cities.state_id', '=', 'states.id')

            ->where('countries.id','=', $countryId)
            ->where('states.id', '=', $stateId)

			
			->orderby('cities.city_name', 'ASC')

            ->paginate($itemsByPage);

		return $city;
	}


	public function getCitiesByStateIdByPage($id, $itemsByPage)
	{

         $cities=  $this->model->select(
				'cities.id',
				'states.state_name', 
				'cities.city_name', 
				'cities.city_description',
				'cities.created_at',
				'cities.updated_at')
				
            ->join('states', 'cities.state_id', '=', 'states.id')

            ->where('states.id', '=', $id)

			->orderby('cities.city_name', 'ASC')

            ->paginate($itemsByPage);

		return $cities;
	}
	
	
	public function store($request)
	{
		// find if exist the state_name and city_name contains in the request
		$city=$this->findCity($request);
		
		// update because the city exist
		if ($city->count()>0){

			if (! $this->update($city[0]->id, $request)){
			 	
			 	return false;
			}

		} else {
			// add the city to the database
			if (! $this->save($request)){
			 	
			 	return false;
			}
		}

		return true;

	}


	public function findCity($request)
	{

		$campus=$this->model->select('id')
			->where('state_id','=', $request->input('state_name'))
			->where('city_name','=', $request->input('city_name'))
			->get();

		return $campus;

	}



	public function save($request)
	{

		try{
			$model                            = new $this->model;		
			
			$model->country_id       = $request->input('country_name');
			$model->state_id         = $request->input('state_name');
			$model->city_name        = $request->input('city_name');
			$model->city_description = $request->input('city_description');
			
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

			$model->city_name        = $request->input('city_name');
			$model->city_description = $request->input('city_description');
			
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
			// find a city id to delete it
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


	/*public function search($value, $itemsByPage)
	{

		$cities=$this->model->select(
			'cities.id',
			'states.state_name', 
			'cities.city_name', 
			'cities.city_description',
			'cities.created_at',
			'cities.updated_at')

        ->join('states', 'cities.state_id', '=', 'states.id')

		->where('states.state_name','like','%' . $value . '%')
		->where(function ($query) use ($value)
			{
				$query->orwhere('cities.city_name','like','%' . $value . '%')
				  	  ->orwhere('cities.city_description','like','%' . $value . '%');
		 	})

		->orderby('states.state_name', 'ASC')
		->orderby('cities.city_name', 'ASC')

	 	->paginate($itemsByPage);

		return $cities;

	}*/


	public function import($file, $stateID)
	{

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		try {
			//load the file to the database	
			$cities=\Excel::load($file->getRealPath(), function($reader) use ($stateID) {
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
							$rowId->institute_id     = $stateID;
							$rowId->city_name        = $row->city_name;
							$rowId->city_description = $row->city_description;
							$rowId->touch();  			//touch: update timestamps
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{

							$rowId                   = new $this->model;
							$rowId->institute_id     = $stateID;
							$rowId->city_name        = $row->city_name;
							$rowId->city_description = $row->city_description;
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
