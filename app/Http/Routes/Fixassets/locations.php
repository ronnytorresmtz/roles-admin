<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('fixassets/locations', 'ProgramController', array(
	    'names' => array(
			'index'   => 'fixassets.locations.index',
			'create'  => 'fixassets.locations.create',
			'store'   => 'fixassets.locations.store',
			'show'    => 'fixassets.locations.show',
			'edit'    => 'fixassets.locations.edit',
			'update'  => 'fixassets.locations.update',
			'destroy' => 'fixassets.locations.destoy'
	    )
	));

	
});

