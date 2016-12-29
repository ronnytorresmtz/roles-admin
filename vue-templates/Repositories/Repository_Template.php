<?php namespace Megacampus\Repositories\ucfirstModelTemplate;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\ucfirstModelTemplate\ucfirstModelTemplateRepositoryInterface;

use  DB, Exception, Lang, ucfirstModelTemplate, Session;
 
class ucfirstModelTemplateRepository extends MyAbstractEloquentRepository implements ucfirstModelTemplateRepositoryInterface 
{
 
	// Properties

	protected $model;

	 
	//Constructor
	   
	public function __construct(ucfirstModelTemplate $model) 
	{
	    $this->model = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}

	public function getAllucfirstModelTemplates($itemsByPage)
	{
		
		$modelTemplates=$this->model->withTrashed()->paginate($itemsByPage);

		return $modelTemplates;
	}

	public function getAllucfirstModelTemplatesActive($itemsByPage = null)
	{

		if ($itemsByPage)
			$modelTemplates=$this->model->select(['id','modelTemplate_name'])->paginate($itemsByPage);
		else
			$modelTemplates=$this->model->select(['id','modelTemplate_name'])->get();

		return $modelTemplates;
	}


	public function getucfirstModelTemplateByID($id)
	{

		$modelTemplate=$this->model->where('id', '=', $id)->first();

		return $modelTemplate;
	}

	public function getucfirstModelTemplateIDByucfirstModelTemplateName($modelTemplateName)
	{

		$modelTemplateID=$this->model->where('modelTemplate_name', '=', $modelTemplateName)->first();

		return $modelTemplateID->id;
	}



	public function store($request)
	{
		try{
			// store the data to the database
			$model                   = new ucfirstModelTemplate;		
			
			$model->modelTemplate_name        = $request->input('modelTemplate_name');
			$model->modelTemplate_description = $request->input('modelTemplate_description');
			
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

			$model->modelTemplate_name        = $request->input('modelTemplate_name');
			$model->modelTemplate_description = $request->input('modelTemplate_description');
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
			// find a modelTemplate id to delete it
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

		// find the string in the database and return the modelTemplates found
		return 	$this->model->withTrashed()->where('modelTemplate_name','like','%' . $value . '%')
							->where(function ($query) use ($value){
								$query->orwhere('modelTemplate_description','like','%' . $value . '%');
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
					
					$rowId->modelTemplate_name        = $file[$i]['modelTemplate_name'];
					$rowId->modelTemplate_description = $file[$i]['modelTemplate_description'];
					$rowId->deleted_at       = null;
					$rowId->touch();  			//touch: update timestamps
					$rowId->save();
					$updateRecords++;
				}
				// validate no found so ADD it
				else{
					$rowId                   = new $this->model;
					$rowId->modelTemplate_name        = $file[$i]['modelTemplate_name'];
					$rowId->modelTemplate_description = $file[$i]['modelTemplate_description'];
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