<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('resources/employees', 'ProgramController', array(
	    'names' => array(
			'index'   => 'resources.employees.index',
			'create'  => 'resources.employees.create',
			'store'   => 'resources.employees.store',
			'show'    => 'resources.employees.show',
			'edit'    => 'resources.employees.edit',
			'update'  => 'resources.employees.update',
			'destroy' => 'resources.employees.destoy'
	    )
	));

	
});

