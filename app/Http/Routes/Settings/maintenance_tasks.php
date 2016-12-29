<?php
Route::group(array('middleware' => 'auth'), function(){

	Route::group(array('middleware' => 'auth'), function(){


	Route::post('settings/maintenance_tasks/executeButton', array (

		'as'			=> 'settings.maintenance_tasks.executeButton',
		'uses' 			=> 'MaintenanceTaskController@postExecuteButton'
	));

	Route::post('settings/maintenance_tasks/viewLogButton', array (

		'as'			=> 'settings.maintenance_tasks.viewLogButton',
		'uses' 			=> 'MaintenanceTaskController@postViewLogButton'
	));
	

	Route::get('settings/maintenance_tasks/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'settings.maintenance_tasks.search',
		'uses' 			=> 'MaintenanceTaskController@getSearch'
	));

	Route::resource('settings/maintenance_tasks', 'MaintenanceTaskController', array(
	    'names' => array(
			'index'   => 'settings.maintenance_tasks.index',
			'create'  => 'settings.maintenance_tasks.create',
			'store'   => 'settings.maintenance_tasks.store',
			'show'    => 'settings.maintenance_tasks.show',
			'edit'    => 'settings.maintenance_tasks.edit',
			'update'  => 'settings.maintenance_tasks.update',
			'destroy' => 'settings.maintenance_tasks.destoy'
	    )
	));


	
});
});



