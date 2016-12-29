<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('services/assigments', 'ProgramController', array(
	    'names' => array(
			'index'   => 'services.assigments.index',
			'create'  => 'services.assigments.create',
			'store'   => 'services.assigments.store',
			'show'    => 'services.assigments.show',
			'edit'    => 'services.assigments.edit',
			'update'  => 'services.assigments.update',
			'destroy' => 'services.assigments.destoy'
	    )
	));

	
});

