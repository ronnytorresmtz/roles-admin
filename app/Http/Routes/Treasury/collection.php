<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('treasury/collection', 'ProgramController', array(
	    'names' => array(
			'index'   => 'treasury.collection.index',
			'create'  => 'treasury.collection.create',
			'store'   => 'treasury.collection.store',
			'show'    => 'treasury.collection.show',
			'edit'    => 'treasury.collection.edit',
			'update'  => 'treasury.collection.update',
			'destroy' => 'treasury.collection.destoy'
	    )
	));

	
});

