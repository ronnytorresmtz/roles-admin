<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('resources/students', 'ProgramController', array(
	    'names' => array(
			'index'   => 'resources.students.index',
			'create'  => 'resources.students.create',
			'store'   => 'resources.students.store',
			'show'    => 'resources.students.show',
			'edit'    => 'resources.students.edit',
			'update'  => 'resources.students.update',
			'destroy' => 'resources.students.destoy'
	    )
	));

	
});

