<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('dashboard/absenteeism', 'ProgramController', array(
	    'names' => array(
			'index'   => 'dashboard.absenteeism.index',
			'create'  => 'dashboard.absenteeism.create',
			'store'   => 'dashboard.absenteeism.store',
			'show'    => 'dashboard.absenteeism.show',
			'edit'    => 'dashboard.absenteeism.edit',
			'update'  => 'dashboard.absenteeism.update',
			'destroy' => 'dashboard.absenteeism.destoy'
	    )
	));

	
});

