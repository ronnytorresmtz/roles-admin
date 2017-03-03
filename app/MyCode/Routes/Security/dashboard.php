
<?php


Route::group(array('middleware' => 'auth'), function(){


	//Security - Dashboard - Users Logged
	Route::post('security/dashboard/usersLoggedByDay', array(

		'as' 	=> 'security.dashboard.usersLoggedByDay', 
		'uses' 	=> 'UserController@postSecurityUsersLoggedByDay'
	));

	Route::get('security/dashboard/usersLogged', array(

		'as' 	=> 'security.dashboard.usersLogged', 
		'uses' 	=> 'UserController@getSecurityUsersLogged'
	));

	Route::get('security/dashboard/actionsByUsersLogged', array(

		'as' 	=> 'security.dashboard.actionsByUsersLogged', 
		'uses' 	=> 'UserController@getSecurityActionsByUsersLogged'
	));

	Route::post('security/dashboard/usersLoggedByMonth', array(

		'as' 	=> 'security.dashboard.usersLoggedByMonth', 
		'uses' 	=> 'UserController@postSecurityUsersLoggedByMonth'
	));


	//Security - Dashboard - Modules used
	Route::post('security/dashboard/modulesUsedByDay', array(

		'as' 	=> 'security.dashboard.modulesUsedByDay', 
		'uses' 	=> 'ModuleController@postSecurityModulesUsedByDay'
	));

	Route::get('security/dashboard/modulesUsed', array(

		'as' 	=> 'security.dashboard.modulesUsed', 
		'uses' 	=> 'ModuleController@getSecurityModulesUsed'
	));

	Route::post('security/dashboard/modulesUsedByMonth', array(

		'as' 	=> 'security.dashboard.modulesUsedByMonth', 
		'uses' 	=> 'ModuleController@postSecurityModulesUsedByMonth'
	));


	//Security - Dashboard - Transactions Used
	Route::post('security/dashboard/transactionsUsedByDay', array(

		'as' 	=> 'security.dashboard.transactionsUsedByDay', 
		'uses' 	=> 'TransactionController@postSecurityTransactionsUsedByDay'
	));

	Route::get('security/dashboard/transactionsUsed', array(

		'as' 	=> 'security.dashboard.transactionsUsed', 
		'uses' 	=> 'TransactionController@getSecurityTransactionsUsed'
	));

	Route::post('security/dashboard/transactionsUsedByMonth', array(

		'as' 	=> 'security.dashboard.transactionsUsedByMonth', 
		'uses' 	=> 'TransactionController@postSecurityTransactionsUsedByMonth'
	));


	//Security - Dashboard - Actions Used
	Route::post('security/dashboard/transactionsActionsUsedByDay', array(

		'as' 	=> 'security.dashboard.transactionsActionsUsedByDay', 
		'uses' 	=> 'TransactionActionController@postSecurityTransactionsActionsUsedByDay'
	));

	Route::get('security/dashboard/transactionsActionsUsed', array(

		'as' 	=> 'security.dashboard.transactionsActionsUsed', 
		'uses' 	=> 'TransactionActionController@getSecurityTransactionsActionsUsed'
	));

	Route::post('security/dashboard/transactionsActionsUsedByMonth', array(

		'as' 	=> 'security.dashboard.transactionsActionsUsedByMonth', 
		'uses' 	=> 'TransactionActionController@postSecurityTransactionsActionsUsedByMonth'
	));

	
});






