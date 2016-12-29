<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('academic/subjects', 'ProgramController', array(
	    'names' => array(
			'index'   => 'academic.subjects.index',
			'create'  => 'academic.subjects.create',
			'store'   => 'academic.subjects.store',
			'show'    => 'academic.subjects.show',
			'edit'    => 'academic.subjects.edit',
			'update'  => 'academic.subjects.update',
			'destroy' => 'academic.subjects.destoy'
	    )
	));

	
});

