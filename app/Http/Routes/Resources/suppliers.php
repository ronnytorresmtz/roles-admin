<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('resources/suppliers', 'ProgramController', array(
	    'names' => array(
			'index'   => 'resources.suppliers.index',
			'create'  => 'resources.suppliers.create',
			'store'   => 'resources.suppliers.store',
			'show'    => 'resources.suppliers.show',
			'edit'    => 'resources.suppliers.edit',
			'update'  => 'resources.suppliers.update',
			'destroy' => 'resources.suppliers.destoy'
	    )
	));

	
});

