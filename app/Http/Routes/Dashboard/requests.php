<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('dashboard/requests', 'ProgramController', array(
	    'names' => array(
			'index'   => 'dashboard.requests.index',
			'create'  => 'dashboard.requests.create',
			'store'   => 'dashboard.requests.store',
			'show'    => 'dashboard.requests.show',
			'edit'    => 'dashboard.requests.edit',
			'update'  => 'dashboard.requests.update',
			'destroy' => 'dashboard.requests.destoy'
	    )
	));

	
});

