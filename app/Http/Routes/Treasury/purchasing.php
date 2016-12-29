<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('treasury/purchasing', 'ProgramController', array(
	    'names' => array(
			'index'   => 'treasury.purchasing.index',
			'create'  => 'treasury.purchasing.create',
			'store'   => 'treasury.purchasing.store',
			'show'    => 'treasury.purchasing.show',
			'edit'    => 'treasury.purchasing.edit',
			'update'  => 'treasury.purchasing.update',
			'destroy' => 'treasury.purchasing.destoy'
	    )
	));

	
});

