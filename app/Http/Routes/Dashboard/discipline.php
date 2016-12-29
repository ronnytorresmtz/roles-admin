<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('dashboard/discipline', 'ProgramController', array(
	    'names' => array(
			'index'   => 'dashboard.discipline.index',
			'create'  => 'dashboard.discipline.create',
			'store'   => 'dashboard.discipline.store',
			'show'    => 'dashboard.discipline.show',
			'edit'    => 'dashboard.discipline.edit',
			'update'  => 'dashboard.discipline.update',
			'destroy' => 'dashboard.discipline.destoy'
	    )
	));

	
});

