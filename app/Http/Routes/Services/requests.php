<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('services/requests', 'ProgramController', array(
	    'names' => array(
			'index'   => 'services.requests.index',
			'create'  => 'services.requests.create',
			'store'   => 'services.requests.store',
			'show'    => 'services.requests.show',
			'edit'    => 'services.requests.edit',
			'update'  => 'services.requests.update',
			'destroy' => 'services.requests.destoy'
	    )
	));

	
});

