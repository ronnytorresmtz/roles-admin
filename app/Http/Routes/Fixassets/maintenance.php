<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('fixassets/maintenance', 'ProgramController', array(
	    'names' => array(
			'index'   => 'fixassets.maintenance.index',
			'create'  => 'fixassets.maintenance.create',
			'store'   => 'fixassets.maintenance.store',
			'show'    => 'fixassets.maintenance.show',
			'edit'    => 'fixassets.maintenance.edit',
			'update'  => 'fixassets.maintenance.update',
			'destroy' => 'fixassets.maintenance.destoy'
	    )
	));

	
});

