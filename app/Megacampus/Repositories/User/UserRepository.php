<?php namespace Megacampus\Repositories\User;

use App\Events\RegisterTransactionAccessEvent;
use Megacampus\Services\Graph\GraphServiceInterface;
use Megacampus\Services\Login\LoginServiceInterface;
use Megacampus\Services\Mail\MailServiceInterface;
use Megacampus\Repositories\Eloquent\MyAbstractEloquentRepository;
use Megacampus\Repositories\User\UserRepositoryInterface;
use Megacampus\Services\Validation\ValidationServiceInterface;

use Auth, DB, Exception, Event,	Hash, Input, Lang, Mail, Session, URL, User, UserActionLog, Role;
 
class UserRepository extends MyAbstractEloquentRepository implements UserRepositoryInterface 
{
 
 	// Properties
	protected $model;
	protected $mailService;
	protected $role;
	protected $loginService;

	// Constructor
	public function __construct(User $model, Role $role, MailServiceInterface $mailService, GraphServiceInterface $graphService)
	{
		$this->model        = $model; 
		$this->role         = $role;
		$this->mailService  = $mailService;
		$this->graphService = $graphService;
	}


	public function getInputRules($form, $request)
	{
		//get the input rules for the validation class
		return $this->model->getInputRules($form, $request);
	}


	public function getInputMessages($langFileAttributes)
	{
		//get the input messages for validation class
		return $this->model->getInputMessages($langFileAttributes);
	}

	//send a mail to the user with a token and security code to reset his password
	public function sendTokenToUserViaMail($request)
	{
		try 
		{
			DB::beginTransaction();
		
			$user= $this->model->where('email','=', $request['email'])->first();
			//email was not found redirect to same view
			if (!isset($user)){
				//set the error message for the user
				return array('error' => true, 'message' => Lang::get('messages.error_email_no_found'));
			}
			//generated and save remember_security_number and token in user table
			$user->remember_security_number=str_random(8);
			$user->remember_token = str_random(60);		

			// save the remember token and security number in the user table
			if (! $user->save()){

				DB::rollBack();

				return array('error' => true, 'message' => Lang::get('messages.error_password_sent'));
			}
				// send a mail with the token and security code to reset his passoword
			if ( ! $this->mailService->sentTokenToResetPassoword($user)){

				DB::rollBack();
				//set the error message for the user
				return array('error' => true, 'message' => Lang::get('messages.error_password_sent'));
			}
			
			DB::commit();

			//set the error message for the user
			return array('error' => false, 'message' => Lang::get('messages.success_password_sent'));

		} catch (Exception $e) {
			DB::rollback();
			//set the error message for the user
			return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .' ' . str_replace("'"," ", $e->getMessage()));
		}
	}


	// reset the user passoword base on a token and security number sent to him via mail.
	public function resetUserPassowrd($request)
	{
		try
		{
			$user= $this->model
					->where('remember_security_number','=', $request['security_number'])
					->where('remember_token','=', $request['token'])
					->first();
			//verity if the security code does not exsit in the database to display a message error
			if (!isset($user)){
				return array('error' => true, 'message' => Lang::get('messages.error_remember_security_number_noexist'));
			}		
			//reset the user password in the database
			$user->password							= Hash::make($request['new_password']);
			$user->remember_security_number			='';
			$user->remember_token 					='';
			//save the reset ot the user password in the user table
			if (! $user->save()){
				//set the error message for the user
				return array('error' => true, 'message' => Lang::get('messages.error_password_wasnot_reset'));
			}
			//set the info message for the user
			return array('error' => false, 'message' => Lang::get('messages.success_password_was_reset'));

		} catch (Exception $e) {
			//set the error message for the user
			return array('error' => true, 'message' =>  Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}
	}


	public function getModel()
	{

		return  $this->model;
	}


	public function getAllUsersByPage($itemsByPage)
	{

		$users=$this->model->withTrashed()->select(
			'users.id', 
			'users.username',
			'users.user_fullname',
			'users.email',
			'roles.role_name',
			'users.deleted_at',
			'users.created_at',
			'users.updated_at'
			)

		->join('roles', 'users.role_id','=', 'roles.id')

		->paginate($itemsByPage);

		return $users;
	}


	public function getAllUsers()
	{
		$users=$this->model->withTrashed()->select(
			'users.id', 
			'users.username',
			'users.user_fullname',
			'users.email',
			'roles.role_name',
			'users.deleted_at',
			'users.created_at',
			'users.updated_at'
			)

		->join('roles', 'users.role_id','=', 'roles.id')

		->get();

		return $users;
	}
	

	public function store($request)
	{
		// store the data to the database
		$result=[];
		try
		{
			DB::beginTransaction();

		 	$model                = new $this->model;		
			
			$model->username      = $request->input('username');
			$model->password      = Hash::make(str_random(8)); //set a random password to user change the password with mail he will receive
			$model->user_fullname = $request->input('user_fullname');
			$model->email         = $request->input('email');
			$model->role_id       = $request->input('role_name');
			$model->save();

			//send a email to the user with a token to change password as he wish
			$result= $this->sendTokenToUserViaMail($request);

			if ($result['error']){

				DB::rollBack();

				return $result;
			}

			DB::commit();

			return $result;


		} catch (Exception $e){

			DB::rollBack();

			 return array('error' => true, 'message' => Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
		}
		

	}


	public function update($id, $request)
	{
		try{
			// store the data to the database
			$model = $this->model->withTrashed()->find($id);

			$model->username      = $request->input('username');
			$model->user_fullname = $request->input('user_fullname');
			$model->email         = $request->input('email');
			$model->role_id       = $request->input('role_name');
			$model->deleted_at    = null;
			
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
		// find a transaction id to delete it
		try
		{
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

	 $users=$this->model->withTrashed()->select(
			'users.id', 
			'users.username',
			'users.user_fullname',
			'users.email',
			'roles.role_name',
			'users.deleted_at',
			'users.created_at',
			'users.updated_at'
			)

		->join('roles', 'users.role_id','=', 'roles.id')
		->where('users.id','like','%' . $value . '%')
		->orwhere(function ($query) use ($value) {
			$query->orwhere('users.username','like','%' . $value . '%')
	 			  ->orwhere('users.user_fullname','like','%' . $value . '%')
	 			  ->orwhere('users.email','like','%' . $value . '%')
	 			  ->orwhere('roles.role_name','like','%'. $value . '%');
		})
		->paginate($itemsByPage);

		return $users;

	}


	public function import($modelRepository, $file)
	{


		/// 
		/// FALTA CORREFIR Y CAMBIAR A QUE SE PARA USER Y NO PARA MODULE.
		/// 

		/*=====================	RULES TO IMPORt FILES ========================================
		1) The first row must be the fields hearder .
		2) if the row has a value in the ID Field it will be update if not will be added.
		===================================================================================*/
		
		// Begin a Transaction
		DB::beginTransaction();

		try {
			//load the file to the database	
			$transactions=\Excel::load($file->getRealPath(), function($reader) use ($modelRepository) {
				//get the file content / data
				$results = $reader->get();	
				$i=0; // caount add records
				$j=0; // count update records
				foreach ($results as $key => $row)  {
					// Validate if the file uploaded has the ID field
					if (isset($row)) {
						// find the id to decide if it wil be an update or add process
						$rowId= $this->model->find($row->id);
						
						$roleId=$modelRepository->getRoleIDByRoleName($row->role_name);

						if ( ! isset($roleId)){
							
							Session::flash('error', Lang::get('messages.error_role_name') . $row->user_name);
 
							return false;
						}
						//validate if $id was found so UPDATE it
						if ($rowId) {
							$rowId->username      = $row->username;
							$rowId->user_fullname = $row->user_fullname;
							$rowId->email         = $row->email;
							$rowId->role_id       = $roleId;
							$rowId->touch();  	//touch: update timestamps
							$rowId->save();
							$j++;
						}
						// validate no found so ADD it
						else{
							$rowId                = new $this->model;
							$rowId->username      = $row->username;
							$rowId->password      = Hash::make(str_random(8)); //set a random password to user change the password with mail he will receive
							$rowId->user_fullname = $row->user_fullname;
							$rowId->email         = $row->email;
							$rowId->role_id       = $roleId;
							$rowId->save();
							$i++;
							//send a email to the new user to set his/her password
							//$this->model->sendTokenToUserViaMail($rowId);
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
			Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));Session::flash('error', Lang::get('messages.error_caught_exception') .'&nbsp;' . str_replace("'"," ", $e->getMessage()));
			//Rollback the Transaction
			DB::rollBack();

			return false;
		}

	}

	
    public function getUsersLoggedbyDay($request)
    {
		$usersByMonthDay = DB::select('
		Select month, day, count(*) users 
		From
			(Select 
				month(created_at) as month, day(created_at) as day, username  
				From users_actions_log
			Where month(created_at) = ' . $request->month . ' and year(created_at) =' . $request->year . ' and action_name=\'login\'' .
			' group by month, day, username) as UserbyMonth

			Group By month, day'
		);

		$daysArray=[];
		$currentDate=getdate();
		//reset all days with 0 for the days of the month (30,31,28,29)
		for ($i=1; $i <= cal_days_in_month(CAL_GREGORIAN, $request->month , $request->year); $i++) { 

			array_push($daysArray, $i);

			if ($request->year < $currentDate['year']){
					$userByDay['series'][]=0;
			}	else {
			if (($i > $currentDate['mday']) && ($request->month == $currentDate['mon']) || ($request->year > $currentDate['year'])) {
				$userByDay['series'][]=null;
			} 
			else {
				$userByDay['series'][]=0;
			}
			}
		}
		
		//fill days with values
		foreach ($usersByMonthDay as $dayAndValue) {
			$userByDay['series'][$dayAndValue->day-1]=$dayAndValue->users;
		}
		
		$userByDay['labels'] = $daysArray; //shortMonths, longMonths, numericMonths
		$userByDay['legend'] = ['Users'];

		return $userByDay;
				
    }


  	public function getUsersLogged($request, $itemsByPage)
	{
		$usersLogged = UserActionLog::select(DB::raw(
				'users_actions_log.username, 
				users.user_fullname, 
				count(users_actions_log.id) as timeslogged'
		))

		->join('users', 'users.username', '=', 'users_actions_log.username' )
		->where('users_actions_log.action_name','=', 'login')
		->whereMonth('users_actions_log.created_at','=', $request->month)
		->whereYear('users_actions_log.created_at','=', $request->year)
		->groupBy('users_actions_log.username', 'users.user_fullname')
		->orderBy ('timeslogged', 'desc')

		->paginate($itemsByPage);

		return $usersLogged;

   }


   public function getActionsByUsersLogged($request, $itemsByPage)
   {
		$usersLogged = UserActionLog::select(DB::raw(
			"username, 
			concat_WS('.',module_name, transaction_name, action_name) as action,
			count(id) as timeslogged"
		))

		->where('action_name','!=', 'login')
		->where('username','!=', 'guest')
		->whereMonth('created_at','=', $request->month)
		->whereYear('created_at','=', $request->year)
		->groupBy('username', 'module_name','transaction_name', 'action_name')
		->orderBy ('username', 'asc')
		->orderBy ('timeslogged', 'desc')

		->paginate($itemsByPage);

		return $usersLogged;

  	}


    public function getUsersLoggedbyMonth($request)
	{
		$usersByMonth = DB::select('
			Select month, count(*) users 
			From
			(Select 
				month(created_at) as month, username  
				From users_actions_log
			Where year(created_at) =' . $request->year . ' and action_name=\'login\'' .
			' group by month, username) as UserbyMonth

			Group By month'
		);

    	//reset all month with 0	
    	for ($i=0; $i < 12; $i++) { 
    		$MonthAndValues['series'][]=0;
    	}

    	//fill months with values
    	foreach ($usersByMonth as $userByMonth) {
    		$MonthAndValues['series'][$userByMonth->month-1]=$userByMonth->users;
    	}

    	$MonthAndValues['labels'] = Lang::get('calendar.shortMonths'); //shortMonths, longMonths, numericMonths
     	$MonthAndValues['legend'] = ['Users'];
    	// retrun just the series data to update the graph
   		return $MonthAndValues;
    }

}


//How to use of cal_info
// $userByDay['labels'] = cal_info(0)['months'];
// $userByDay['labels'] = cal_info(0)['abbrevmonths'];
// $userByDay['maxdaysinmonth'] = cal_days_in_month(CAL_GREGORIAN, $request->month , $request->year);
