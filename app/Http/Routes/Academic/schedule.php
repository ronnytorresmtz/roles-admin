<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('academic/schedule', 'ProgramController', array(
	    'names' => array(
			'index'   => 'academic.schedule.index',
			'create'  => 'academic.schedule.create',
			'store'   => 'academic.schedule.store',
			'show'    => 'academic.schedule.show',
			'edit'    => 'academic.schedule.edit',
			'update'  => 'academic.schedule.update',
			'destroy' => 'academic.schedule.destoy'
	    )
	));

	
});

