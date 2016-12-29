<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('treasury/autorizations', 'ProgramController', array(
	    'names' => array(
			'index'   => 'treasury.autorizations.index',
			'create'  => 'treasury.autorizations.create',
			'store'   => 'treasury.autorizations.store',
			'show'    => 'treasury.autorizations.show',
			'edit'    => 'treasury.autorizations.edit',
			'update'  => 'treasury.autorizations.update',
			'destroy' => 'treasury.autorizations.destoy'
	    )
	));

	
});

