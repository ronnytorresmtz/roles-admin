<?php namespace Megacampus\Repositories\Language;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Services\Graph\GraphServiceInterface;
use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\Language\LanguageRepositoryInterface;

use  DB, Exception, Lang, Language, Session;
 
class LanguageRepository extends MyAbstractEloquentRepository implements LanguageRepositoryInterface 
{
 
	// Properties

	protected $model;
	protected $graphService;

	 
	//Constructor
	   
	public function __construct(Language $model, GraphServiceInterface $graphService) 
	{
		$this->model        = $model; 
		$this->graphService = $graphService;
	}


	public function getModel()
	{
	
		return  $this->model;
	}


	public function getAllLanguages()
	{

		$languages=$this->model->all(['language_name','id']);

		return $languages;
	}

	public function getLanguageNameByID($id)
	{

		$language=$this->model->where('id', '=', $id)->first();

		return $language;
	}

	public function getLanguageIdByLanguageName($languageName)
	{

		$language=$this->model->where('language_name', '=', $languageName)->first(array('id'));

		$id=null;

		if (isset($language)){
			
			$language=$language->toArray();

			$id= array_pop($language);
		}

		return $id;
	}
	
	
	public function store($request)
	{
		try{
			// store the data to the database
			$model                      = new Language;		
			
			$model->language_name        = $request->input('language_name');
			$model->language_description = $request->input('language_description');
			
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

			$model->language_name        = $request->input('language_name');
			$model->language_description = $request->input('language_description');
			
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
			// find a language id to delete it
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

		// find the string in the database and return the languages found
		return 	$this->model->where('language_name','like','%' . $value . '%')
							->where(function($query) use ($value){
								$query->orwhere('language_description','like','%' . $value . '%');
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
			$languages=\Excel::load($file->getRealPath(), function($reader) {
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
							$rowId->language_name      	= $row->language_name;
							$rowId->language_description	= $row->language_description;
							$rowId->touch();  			//touch: update timestamps
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{

							$rowId                      = new $this->model;
							$rowId->language_name        = $row->language_name;
							$rowId->language_description = $row->language_description;
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