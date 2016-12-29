<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('academic/levels', 'ProgramController', array(
	    'names' => array(
			'index'   => 'academic.levels.index',
			'create'  => 'academic.levels.create',
			'store'   => 'academic.levels.store',
			'show'    => 'academic.levels.show',
			'edit'    => 'academic.levels.edit',
			'update'  => 'academic.levels.update',
			'destroy' => 'academic.levels.destoy'
	    )
	));

	
});

