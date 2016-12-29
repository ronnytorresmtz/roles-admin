<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('academic/assignments', 'ProgramController', array(
	    'names' => array(
			'index'   => 'academic.assignments.index',
			'create'  => 'academic.assignments.create',
			'store'   => 'academic.assignments.store',
			'show'    => 'academic.assignments.show',
			'edit'    => 'academic.assignments.edit',
			'update'  => 'academic.assignments.update',
			'destroy' => 'academic.assignments.destoy'
	    )
	));

	
});

