<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('academic/grades', 'ProgramController', array(
	    'names' => array(
			'index'   => 'academic.grades.index',
			'create'  => 'academic.grades.create',
			'store'   => 'academic.grades.store',
			'show'    => 'academic.grades.show',
			'edit'    => 'academic.grades.edit',
			'update'  => 'academic.grades.update',
			'destroy' => 'academic.grades.destoy'
	    )
	));

	
});

