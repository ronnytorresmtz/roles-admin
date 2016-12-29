<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('academic/cycles', 'ProgramController', array(
	    'names' => array(
			'index'   => 'academic.cycles.index',
			'create'  => 'academic.cycles.create',
			'store'   => 'academic.cycles.store',
			'show'    => 'academic.cycles.show',
			'edit'    => 'academic.cycles.edit',
			'update'  => 'academic.cycles.update',
			'destroy' => 'academic.cycles.destoy'
	    )
	));

	
});

