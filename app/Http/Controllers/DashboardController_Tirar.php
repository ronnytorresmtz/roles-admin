<?php

use Megacampus\Services\Graph\GraphServiceInterface;


class DashboardController extends Controller {
	/**
	* Setup the layout used by the controller.
	*
	* @return void
	*/

	protected $graphService;

 	public function __construct(GraphServiceInterface $graphService)
    {
      
		$this->graphService = $graphService;
    }


    public function getSecurityUserStatistics()
    {
      	$usersByMonthDay = DB::select('
      	 	Select month, day, count(*) users
      	 	From
				(Select month(created_at) as month, day(created_at) as day, username  
					From homestead.users_actions_log
                    Where month(created_at) = month(now())
                    group by month, day, username) as UserbyMonth

				Group By month, day'
		);
      	
      	for ($i=0; $i < (integer) date('t'); $i++) { 
      		$userByDay[]=0;
      	}

      	foreach ($usersByMonthDay as $dayAndValue) {

      		$userByDay[$dayAndValue->day-1]=$dayAndValue->users;
      	}

		$chartByDay=$this->graphService->makeDailyGraph('line', 'Users', $userByDay, 'amount_users_logged_by_day');	    
		
//-----

		$usersByMonth = DB::select('
      	 	Select month,  count(*) users
      	 	From
				(Select month(created_at) as month, username  
					From homestead.users_actions_log
                    Where year(created_at) = year(now())
                    group by month, username) as UserbyMonth
				Group By month'
		);

		//dd($usersByMonthDay);

      	for ($i=0; $i < 12; $i++) { 
      		$MonthAndValues[]=0;
      	}

      	foreach ($usersByMonth as $userByMonth) {

      		$MonthAndValues[$userByMonth->month-1]=$userByMonth->users;
      	}

	    
		$chartByMonth=$this->graphService->makeMonthlyGraph('column', 'Users', $MonthAndValues, 'shortMonths', 'amount_users_logged_by_month');		
	    	
		//----
		
		$usersLogged = DB:: select("
			SELECT a.username, b.user_fullname, count(a.id) as login 
			FROM users_actions_log a inner join users b 
			on a.username=b.username
			where a.action_name='Login'
			group by a.username,b.user_fullname
			order by login desc
		");


		return View::make ('security.dashboard.users')
			->with(array(
				'chartByDay'   =>json_encode($chartByDay),
				'chartByMonth' =>json_encode($chartByMonth),
				'usersLogged'   =>$usersLogged
			));
    }
}