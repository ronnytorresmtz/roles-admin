<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('services/scheduling', 'ProgramController', array(
	    'names' => array(
			'index'   => 'services.scheduling.index',
			'create'  => 'services.scheduling.create',
			'store'   => 'services.scheduling.store',
			'show'    => 'services.scheduling.show',
			'edit'    => 'services.scheduling.edit',
			'update'  => 'services.scheduling.update',
			'destroy' => 'services.scheduling.destoy'
	    )
	));

	
});

