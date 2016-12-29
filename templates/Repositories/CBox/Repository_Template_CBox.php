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
		$this->model        = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}



	public function getAllucfirstModelTemplatesByPage($itemsByPage)
	{

		$modelTemplates= $this->model->select(
				'modelTemplates.id',
				'selectTemplates.selectTemplate_name', 
				'modelTemplates.modelTemplate_name', 
				'modelTemplates.modelTemplate_description',
				'modelTemplates.created_at',
				'modelTemplates.updated_at')

            ->join('selectTemplates', 'modelTemplates.selectTemplate_id', '=', 'selectTemplates.id')

			->orderby('selectTemplates.selectTemplate_name', 'ASC')
			->orderby('modelTemplates.modelTemplate_name', 'ASC')

            ->paginate($itemsByPage);

        return $modelTemplates;

	}


	public function getAllucfirstModelTemplates()
	{

		$modelTemplates = $this->model->select(
				'modelTemplates.id',
				'selectTemplates.selectTemplate_name',
				'modelTemplates.modelTemplate_name', 
				'modelTemplates.modelTemplate_description',
				'modelTemplates.created_at',
				'modelTemplates.updated_at')
        
        	->join('selectTemplates', 'modelTemplates.selectTemplate_id', '=', 'selectTemplates.id')

            ->orderby('selectTemplates.selectTemplate_name', 'ASC')
			->orderby('modelTemplates.modelTemplate_name', 'ASC')

            ->get();

           // var_dump(\Response::json($foods));

		return $modelTemplates;
	}

	public function getucfirstModelTemplateNameByID($id)
	{

		$modeTemplate= $this->model->select(
				'modelTemplates.id',
				'selectTemplates.id as selectTemplate_id', 
				'selectTemplates.selectTemplate_name', 
				'modelTemplates.modelTemplate_name', 
				'modelTemplates.modelTemplate_description',
				'modelTemplates.created_at',
				'modelTemplates.updated_at')

            ->join('selectTemplates', 'modelTemplates.selectTemplate_id', '=', 'selectTemplates.id')

            ->where('modelTemplates.id', '=', $id)

            ->orderby('selectTemplates.selectTemplate_name', 'ASC')
			->orderby('modelTemplates.modelTemplate_name', 'ASC')

            ->get();

		return $modeTemplate;
	}

	public function getucfirstModelTemplateIdByucfirstModelTemplateName($modelTemplateName)
	{
		$modelTemplate=  $this->model->select(
				'modelTemplates.id',
				'selectTemplates.selectTemplate_name', 
				'modelTemplates.modelTemplate_name', 
				'modelTemplates.modelTemplate_description',
				'modelTemplates.created_at',
				'modelTemplates.updated_at')
				
            ->join('selectTemplates', 'modelTemplates.selectTemplate_id', '=', 'selectTemplates.id')


            ->where('modelTemplates.selectTemplate_id', '=', $id)

			
			->orderby('modelTemplates.modelTemplate_name', 'ASC')

            ->paginate($itemsByPage);

		return $modelTemplate;
	}


	public function getucfirstModelTemplateByucfirstSelectTemplate($id, $itemsByPage)
	{

         $modelTemplates=  $this->model->select(
				'modelTemplates.id',
				'selectTemplates.selectTemplate_name', 
				'modelTemplates.modelTemplate_name', 
				'modelTemplates.modelTemplate_description',
				'modelTemplates.created_at',
				'modelTemplates.updated_at')
				
            ->join('selectTemplates', 'modelTemplates.selectTemplate_id', '=', 'selectTemplates.id')

            ->where('selectTemplates.id', '=', $id)

			->orderby('modelTemplates.modelTemplate_name', 'ASC')

            ->paginate($itemsByPage);

		return $modelTemplates;
	}
	
	
	public function store($request)
	{
		// find if exist the selectTemplate_name and modelTemplate_name contains in the request
		$modelTemplate=$this->finducfirstModelTemplate($request);
		
		// update because the modelTemplate exist
		if ($modelTemplate->count()>0){

			if (! $this->update($modelTemplate[0]->id, $request)){
			 	
			 	return false;
			}

		} else {
			// add the modelTemplate to the database
			if (! $this->save($request)){
			 	
			 	return false;
			}
		}

		return true;

	}


	public function finducfirstModelTemplate($request)
	{

		$campus=$this->model->select('id')
			->where('selectTemplate_id','=', $request->input('selectTemplate_name'))
			->where('modelTemplate_name','=', $request->input('modelTemplate_name'))
			->get();

		return $campus;

	}



	public function save($request)
	{

		try{
			$model                            = new $this->model;		
			
			$model->selectTemplate_id         = $request->input('selectTemplate_name');
			$model->modelTemplate_name        = $request->input('modelTemplate_name');
			$model->modelTemplate_description = $request->input('modelTemplate_description');
			
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

			$model->modelTemplate_name        = $request->input('modelTemplate_name');
			$model->modelTemplate_description = $request->input('modelTemplate_description');
			
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
			// find a modelTemplate id to delete it
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

		$modelTemplates=$this->model->select(
			'modelTemplates.id',
			'selectTemplates.selectTemplate_name', 
			'modelTemplates.modelTemplate_name', 
			'modelTemplates.modelTemplate_description',
			'modelTemplates.created_at',
			'modelTemplates.updated_at')

        ->join('selectTemplates', 'modelTemplates.selectTemplate_id', '=', 'selectTemplates.id')

		->where('selectTemplates.selectTemplate_name','like','%' . $value . '%')
		->where(function ($query) use ($value)
			{
				$query->orwhere('modelTemplates.modelTemplate_name','like','%' . $value . '%')
				  	  ->orwhere('modelTemplates.modelTemplate_description','like','%' . $value . '%');
		 	})

		->orderby('selectTemplates.selectTemplate_name', 'ASC')
		->orderby('modelTemplates.modelTemplate_name', 'ASC')

	 	->paginate($itemsByPage);

		return $modelTemplates;

	}


	public function import($file, $selectTemplateID)
	{

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		try {
			//load the file to the database	
			$modelTemplates=\Excel::load($file->getRealPath(), function($reader) use ($selectTemplateID) {
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
							$rowId->institute_id              = $selectTemplateID;
							$rowId->modelTemplate_name        = $row->modelTemplate_name;
							$rowId->modelTemplate_description = $row->modelTemplate_description;
							$rowId->touch();  			//touch: update timestamps
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{

							$rowId                            = new $this->model;
							$rowId->institute_id              = $selectTemplateID;
							$rowId->modelTemplate_name        = $row->modelTemplate_name;
							$rowId->modelTemplate_description = $row->modelTemplate_description;
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
