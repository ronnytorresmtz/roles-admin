<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('resources/teacher', 'ProgramController', array(
	    'names' => array(
			'index'   => 'resources.teachers.index',
			'create'  => 'resources.teachers.create',
			'store'   => 'resources.teachers.store',
			'show'    => 'resources.teachers.show',
			'edit'    => 'resources.teachers.edit',
			'update'  => 'resources.teachers.update',
			'destroy' => 'resources.teachers.destoy'
	    )
	));

	
});

