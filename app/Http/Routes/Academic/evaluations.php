<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('academic/evaluations', 'ProgramController', array(
	    'names' => array(
			'index'   => 'academic.evaluations.index',
			'create'  => 'academic.evaluations.create',
			'store'   => 'academic.evaluations.store',
			'show'    => 'academic.evaluations.show',
			'edit'    => 'academic.evaluations.edit',
			'update'  => 'academic.evaluations.update',
			'destroy' => 'academic.evaluations.destoy'
	    )
	));

	
});

