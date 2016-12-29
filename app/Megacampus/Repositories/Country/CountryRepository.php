<?php namespace Megacampus\Repositories\Country;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Services\Graph\GraphServiceInterface;
use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\Country\CountryRepositoryInterface;

use  DB, Exception, Lang, Country, Session;
 
class CountryRepository extends MyAbstractEloquentRepository implements CountryRepositoryInterface 
{
 
	// Properties

	protected $model;
	protected $graphService;

	 
	//Constructor
	   
	public function __construct(Country $model, GraphServiceInterface $graphService) 
	{
		$this->model        = $model; 
		$this->graphService = $graphService;
	}


	public function getModel()
	{
	
		return  $this->model;
	}


	public function getAllCountries()
	{

		$countries=$this->model->all(['country_name','id']);

		return $countries;
	}

	public function getCountryNameByID($id)
	{

		$country=$this->model->where('id', '=', $id)->first();

		return $country;
	}

	public function getCountryIdByCountryName($countryName)
	{

		$country=$this->model->where('country_name', '=', $countryName)->first(array('id'));

		$id=null;

		if (isset($country)){
			
			$country=$country->toArray();

			$id= array_pop($country);
		}

		return $id;
	}
	
	
	public function store($request)
	{
		try{
			// store the data to the database
			$model                      = new Country;		
			
			$model->country_name        = $request->input('country_name');
			$model->country_description = $request->input('country_description');
			
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

			$model->country_name        = $request->input('country_name');
			$model->country_description = $request->input('country_description');
			
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
			// find a country id to delete it
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

		// find the string in the database and return the countries found
		return 	$this->model->where('country_name','like','%' . $value . '%')
							->where(function($query) use ($value){
								$query->orwhere('country_description','like','%' . $value . '%');
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
			$countries=\Excel::load($file->getRealPath(), function($reader) {
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
							$rowId->country_name      	= $row->country_name;
							$rowId->country_description	= $row->country_description;
							$rowId->touch();  			//touch: update timestamps
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{

							$rowId                      = new $this->model;
							$rowId->country_name        = $row->country_name;
							$rowId->country_description = $row->country_description;
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