<?php namespace Megacampus\Repositories\Role;
 
//use Maatwebsite\Excel\Excel as Excel;

use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\Role\RoleRepositoryInterface;

use  DB, Exception, Lang, Role, Session;
 
class RoleRepository extends MyAbstractEloquentRepository implements RoleRepositoryInterface 
{
 
	// Properties

	protected $model;

	 
	//Constructor
	   
	public function __construct(Role $model) 
	{
	    $this->model = $model; 
	}


	public function getModel()
	{
	
		return  $this->model;
	}

	public function getAllRoles($itemsByPage)
	{
		
		$roles=$this->model->withTrashed()->paginate($itemsByPage);

		return $roles;
	}

	public function getAllRolesActive($itemsByPage = null)
	{

		if ($itemsByPage)
			$roles=$this->model->select(['id','role_name'])->paginate($itemsByPage);
		else
			$roles=$this->model->select(['id','role_name'])->get();

		return $roles;
	}


	public function getRoleByID($id)
	{

		$role=$this->model->where('id', '=', $id)->first();

		return $role;
	}

	public function getRoleIDByRoleName($roleName)
	{

		$roleID=$this->model->where('role_name', '=', $roleName)->first();

		return $roleID->id;
	}



	public function store($request)
	{
		try{
			// store the data to the database
			$model                   = new Role;		
			
			$model->role_name        = $request->input('role_name');
			$model->role_description = $request->input('role_description');
			
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

			$model->role_name        = $request->input('role_name');
			$model->role_description = $request->input('role_description');
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
			// find a role id to delete it
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

		// find the string in the database and return the roles found
		return 	$this->model->withTrashed()->where('id','like','%' . $value . '%')
							->orwhere(function ($query) use ($value){
								$query->orwhere('role_name','like','%' . $value . '%')
											->orwhere('role_description','like','%' . $value . '%');
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
					
					$rowId->role_name        = $file[$i]['role_name'];
					$rowId->role_description = $file[$i]['role_description'];
					$rowId->deleted_at       = null;
					$rowId->touch();  			//touch: update timestamps
					$rowId->save();
					$updateRecords++;
				}
				// validate no found so ADD it
				else{
					$rowId                   = new $this->model;
					$rowId->role_name        = $file[$i]['role_name'];
					$rowId->role_description = $file[$i]['role_description'];
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