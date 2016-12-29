<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('treasury/salaries', 'ProgramController', array(
	    'names' => array(
			'index'   => 'treasury.salaries.index',
			'create'  => 'treasury.salaries.create',
			'store'   => 'treasury.salaries.store',
			'show'    => 'treasury.salaries.show',
			'edit'    => 'treasury.salaries.edit',
			'update'  => 'treasury.salaries.update',
			'destroy' => 'treasury.salaries.destoy'
	    )
	));

	
});

