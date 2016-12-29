<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('services/status', 'ProgramController', array(
	    'names' => array(
			'index'   => 'services.status.index',
			'create'  => 'services.status.create',
			'store'   => 'services.status.store',
			'show'    => 'services.status.show',
			'edit'    => 'services.status.edit',
			'update'  => 'services.status.update',
			'destroy' => 'services.status.destoy'
	    )
	));

	
});

