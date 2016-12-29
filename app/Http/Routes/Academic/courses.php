<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('academic/courses', 'ProgramController', array(
	    'names' => array(
			'index'   => 'academic.courses.index',
			'create'  => 'academic.courses.create',
			'store'   => 'academic.courses.store',
			'show'    => 'academic.courses.show',
			'edit'    => 'academic.courses.edit',
			'update'  => 'academic.courses.update',
			'destroy' => 'academic.courses.destoy'
	    )
	));

	
});

